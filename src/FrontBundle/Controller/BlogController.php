<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Blog:index.html.twig');
    }

    /**
     * @Route("/article", name="article")
     */
    public function articleAction()
    {
        return $this->render('FrontBundle:Blog:article.html.twig');
    }
}
