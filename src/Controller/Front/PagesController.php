<?php

namespace Controller\Front;

use Model\SearchVendorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Model\VendorService;
use Form\VendorServiceFilterType;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $vendorServiceFilter = new SearchVendorService();
        $searchForm = $this->createForm(VendorServiceFilterType::class, $vendorServiceFilter);

        return $this->render('front/pages/home.html.twig', [
            'searchForm' => $searchForm->createView(),
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('front/pages/about.html.twig');
    }

    /**
     * @Route("/404", name="notfound")
     */
    public function notfoundAction()
    {
        return $this->render('front/pages/notfound.html.twig');
    }

    /**
     * @Route("/faq2", name="faq2")
     */
    public function faqAction()
    {
        return $this->render('front/pages/faq.html.twig');
    }

    /**
     * @Route("/help", name="help")
     */
    public function helpAction(Request $request)
    {
        return $this->render('front/pages/help.html.twig');
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function galleryAction()
    {
        return $this->render('front/pages/gallery.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function ContactAction()
    {
        return $this->render('front/pages/contact.html.twig');
    }
}
