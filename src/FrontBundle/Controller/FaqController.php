<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\QueryBuilder\ArticleQueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FaqController extends Controller
{
    /**
     * @Route("/faq/{categoryId}-{alias}", name="faq", defaults={"categoryId":"", "alias":""})
     */
    public function indexAction(Request $request, $categoryId)
    {
        $page = $request->get('page', 1);
        $tag = $request->get('tag', 0);
        $search = $request->get('search', '');
        $cmsApi = $this->get('app.cms_api');

        $faqCategories = $cmsApi->getFaqCategories();
        $faqCategoriesIds = [];

        foreach ($faqCategories->children as $cat) {
            $faqCategoriesIds[] = $cat->id;
        }

        $qb = $cmsApi->getDefaultFaqQueryBuilder();
        $qb->setLimit(6);
        $qb->setCategoryIds($faqCategoriesIds);

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

        $currentCategory = $categoryId ? $cmsApi->getCategories($categoryId) : null;

        return $this->render('FrontBundle:Faq:index.html.twig', [
            'data' => $data,
            'currentCategory' => $currentCategory,
            'search' => $search,
            'faqCategories' => $faqCategories,
        ]);
    }
}
