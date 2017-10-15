<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Pages:home.html.twig');
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
     * @Route("/faq", name="faq")
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
     * @Route("/register", name="register")
     */
    public function registerAction()
    {
        return $this->render('FrontBundle:Pages:register.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function ContactAction()
    {
        return $this->render('FrontBundle:Pages:contact.html.twig');
    }
}
