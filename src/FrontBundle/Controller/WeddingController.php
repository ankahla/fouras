<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\QueryBuilder\ArticleQueryBuilder;
use AppBundle\Services\CmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeddingController extends AbstractController
{
    /**
     * @Route("/wedding_list", name="wedding_list")
     */
    public function indexAction(CmsService $cmsApi)
    {
        $weddings = $cmsApi->getGalleryCategories();

        return $this->render('FrontBundle:Wedding:index.html.twig', ['weddings' => $weddings]);
    }

    /**
     * @Route("/wedding_gallery/{categoryId}-{alias}", name="wedding_gallery")
     */
    public function galleryAction(CmsService $cmsApi, $categoryId)
    {
        $wedding = $cmsApi->getCategories($categoryId);
        
        $qb = new ArticleQueryBuilder();
        $qb->setCategoryIds([$categoryId]);
        $items = $cmsApi->getArticles($qb);

        return $this->render('FrontBundle:Wedding:gallery.html.twig', ['wedding' => $wedding, 'items' => $items]);
    }

    /**
     * @Route("/wedding", name="wedding")
     */
    public function articleAction()
    {
        return $this->render('FrontBundle:Wedding:wedding.html.twig');
    }
}
