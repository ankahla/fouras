<?php

namespace FrontBundle\Controller;

use AppBundle\Services\CmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FaqController extends AbstractController
{
    /**
     * @Route("/faq/{categoryId}-{alias}", name="faq", defaults={"categoryId":"", "alias":""})
     * @param Request    $request
     * @param string $categoryId
     * @param CmsService $cmsApi
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $categoryId, CmsService $cmsApi)
    {
        //$page = $request->get('page', 1);
        $tag = $request->get('tag', 0);
        $search = $request->get('search', '');

        $faqCategories = $cmsApi->getFaqCategories();
        $faqCategoriesIds = [];

        foreach ($faqCategories->children ?? [] as $cat) {
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
