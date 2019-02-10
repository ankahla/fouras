<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\QueryBuilder\ArticleQueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/blog/{categoryId}-{alias}", name="blog", defaults={"categoryId":"", "alias":""})
     */
    public function indexAction(Request $request, $categoryId)
    {
        $page = $request->get('page', 1);
        $tag = $request->get('tag', 0);
        $search = $request->get('search', '');
        $cmsApi = $this->get('app.cms_api');

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
        $newsArticles = $this->getSideNewsArticles();

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
     */
    public function articleAction($id, $alias)
    {
        $cmsApi = $this->get('app.cms_api');

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
        $newsArticles = $this->getSideNewsArticles();
        // blog categories
        $blogCategory = $cmsApi->getBlogCategories();

        return $this->render('FrontBundle:Blog:article.html.twig', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'newsArticles' => $newsArticles,
            'blogCategory' => $blogCategory,
        ]);
    }

    private function getSideNewsArticles()
    {
        $cmsApi = $this->get('app.cms_api');

        $qb = $cmsApi->getDefaultNewsQueryBuilder();
        $qb
            ->setLimit(5)
            ->setSort('modified');

        return $cmsApi->getArticles($qb);
    }
}
