<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WeddingController extends Controller
{
    /**
     * @Route("/wedding_list", name="wedding_list")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Wedding:index.html.twig');
    }

    /**
     * @Route("/wedding", name="wedding")
     */
    public function articleAction()
    {
        return $this->render('FrontBundle:Wedding:wedding.html.twig');
    }
}
