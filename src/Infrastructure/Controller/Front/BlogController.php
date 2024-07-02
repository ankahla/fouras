<?php

namespace Infrastructure\Controller\Front;

use Model\QueryBuilder\ArticleQueryBuilder;
use Services\CmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @param Request    $request
     * @param string  $categoryId
     * @param CmsService $cmsApi
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route(path: '/blog/{categoryId}-{alias}', name: 'blog', defaults: ['categoryId' => '', 'alias' => ''])]
    public function indexAction(Request $request, $categoryId, CmsService $cmsApi)
    {
        $page = $request->get('page', 1);
        $tag = $request->get('tag', 0);
        $search = $request->get('search', '');

        $blogCategory = $cmsApi->getBlogCategories();
        $blogCategoryIds = [];

        foreach ($blogCategory->children ?? [] as $cat) {
            $blogCategoryIds[] = $cat->id;
        }

        $qb = $cmsApi->getDefaultBlogQueryBuilder();
        $qb
            ->setLimit(4)
            ->setPage($page);
        $qb->setCategoryIds($blogCategoryIds);

        if ($tag) {
            $qb
                ->setTag($tag)
                ->setCategoryIds([])
                ;
        } elseif ($search) {
            $qb->setSearch($search);
        } elseif ($categoryId) {
            $qb->setCategoryIds([$categoryId]);
        }

        $data = $cmsApi->getArticles($qb);

        $currentCategory = $cmsApi->getCategories($categoryId);
        
        // news articles
        $newsArticles = $this->getSideNewsArticles($cmsApi);

        return $this->render('front/Blog/index.html.twig', [
            'data' => $data,
            'currentCategory' => $currentCategory,
            'search' => $search,
            'blogCategory' => $blogCategory,
            'newsArticles' => $newsArticles
        ]);
    }

    /**
     * @param string $id
     * @param string $alias
     * @param CmsService $cmsApi
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    #[Route(path: '/article/{id}-{alias}', name: 'article')]
    public function articleAction($id, $alias, CmsService $cmsApi)
    {
        $qb = new ArticleQueryBuilder();
        $qb
            ->setArticleId($id)
            ->addField('fulltext')
            ->addField('tags')
            ->setLimit(1);

        $items = $cmsApi->getArticles($qb);
        $article = reset($items->results);

        if (!isset($article->id)) {
            throw $this->createNotFoundException();
        }

        // related articles
        $qb = new ArticleQueryBuilder();
        $qb
            ->setCategoryIds([$article->catid ?? ''])
            ->setSort('modified')
            ->setFields(['id', 'alias', 'title', 'images']);

        $relatedArticles = $cmsApi->getArticles($qb);
        // news articles
        $newsArticles = $this->getSideNewsArticles($cmsApi);
        // blog categories
        $blogCategory = $cmsApi->getBlogCategories();

        return $this->render('front/Blog/article.html.twig', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'newsArticles' => $newsArticles,
            'blogCategory' => $blogCategory,
        ]);
    }

    /**
     * @param CmsService $cmsApi
     *
     * @return mixed
     */
    private function getSideNewsArticles(CmsService $cmsApi)
    {
        $qb = $cmsApi->getDefaultNewsQueryBuilder();
        $qb
            ->setLimit(5)
            ->setSort('modified');

        return $cmsApi->getArticles($qb);
    }
}
