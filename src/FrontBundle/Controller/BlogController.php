<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\QueryBuilder\ArticleQueryBuilder;
use AppBundle\Services\CmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{categoryId}-{alias}", name="blog", defaults={"categoryId":"", "alias":""})
     * @param Request    $request
     * @param            $categoryId
     * @param $
     * @param CmsService $cmsApi
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $categoryId, CmsService $cmsApi)
    {
        $page = $request->get('page', 1);
        $tag = $request->get('tag', 0);
        $search = $request->get('search', '');

        $blogCategory = $cmsApi->getBlogCategories();
        $blogCategoryIds = [];

        foreach ($blogCategory->children as $cat) {
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

        return $this->render('FrontBundle:Blog:index.html.twig', [
            'data' => $data,
            'currentCategory' => $currentCategory,
            'search' => $search,
            'blogCategory' => $blogCategory,
            'newsArticles' => $newsArticles
        ]);
    }

    /**
     * @Route("/article/{id}-{alias}", name="article")
     * @param            $id
     * @param            $alias
     * @param CmsService $cmsApi
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
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
            return $this->createNotFoundException();
        }

        // related articles
        $qb = new ArticleQueryBuilder();
        $qb
            ->setCategoryIds([$article->catid])
            ->setSort('modified')
            ->setFields(['id', 'alias', 'title', 'images']);

        $relatedArticles = $cmsApi->getArticles($qb);
        // news articles
        $newsArticles = $this->getSideNewsArticles($cmsApi);
        // blog categories
        $blogCategory = $cmsApi->getBlogCategories();

        return $this->render('FrontBundle:Blog:article.html.twig', [
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
