<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\QueryBuilder\ArticleQueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class WeddingController extends Controller
{
    /**
     * @Route("/wedding_list", name="wedding_list")
     */
    public function indexAction()
    {
        $cmsApi = $this->get('app.cms_api');
        $weddings = $cmsApi->getGalleryCategories();

        return $this->render('FrontBundle:Wedding:index.html.twig', ['weddings' => $weddings]);
    }

    /**
     * @Route("/wedding_gallery/{categoryId}-{alias}", name="wedding_gallery")
     */
    public function galleryAction(Request $request, $categoryId)
    {
        $cmsApi = $this->get('app.cms_api');

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
