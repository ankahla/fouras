<?php

namespace Infrastructure\Controller\Front;

use Model\QueryBuilder\ArticleQueryBuilder;
use Services\CmsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeddingController extends AbstractController
{
    #[Route(path: '/wedding_list', name: 'wedding_list')]
    public function indexAction(CmsService $cmsApi)
    {
        $weddings = $cmsApi->getGalleryCategories();

        return $this->render('front/wedding/index.html.twig', ['weddings' => $weddings]);
    }

    #[Route(path: '/wedding_gallery/{categoryId}-{alias}', name: 'wedding_gallery')]
    public function galleryAction(CmsService $cmsApi, $categoryId)
    {
        $wedding = $cmsApi->getCategories($categoryId);
        
        $qb = new ArticleQueryBuilder();
        $qb->setCategoryIds([$categoryId]);
        $items = $cmsApi->getArticles($qb);

        return $this->render('front/wedding/gallery.html.twig', ['wedding' => $wedding, 'items' => $items]);
    }

    #[Route(path: '/wedding', name: 'wedding')]
    public function articleAction()
    {
        return $this->render('front/wedding/wedding.html.twig');
    }
}
