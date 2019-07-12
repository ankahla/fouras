<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\VendorService;
use AppBundle\Form\VendorServiceFilterType;

class PagesController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $vendorServiceFilter = new VendorService();
        $searchForm = $this->createForm(VendorServiceFilterType::class, $vendorServiceFilter);

        return $this->render('FrontBundle:Pages:home.html.twig', [
            'searchForm' => $searchForm->createView(),
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('FrontBundle:Pages:about.html.twig');
    }

    /**
     * @Route("/404", name="notfound")
     */
    public function notfoundAction()
    {
        return $this->render('FrontBundle:Pages:notfound.html.twig');
    }

    /**
     * @Route("/faq2", name="faq2")
     */
    public function faqAction()
    {
        return $this->render('FrontBundle:Pages:faq.html.twig');
    }

    /**
     * @Route("/help", name="help")
     */
    public function helpAction(Request $request)
    {
        return $this->render('FrontBundle:Pages:help.html.twig');
    }

    /**
     * @Route("/gallery", name="gallery")
     */
    public function galleryAction()
    {
        return $this->render('FrontBundle:Pages:gallery.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function ContactAction()
    {
        return $this->render('FrontBundle:Pages:contact.html.twig');
    }
}
