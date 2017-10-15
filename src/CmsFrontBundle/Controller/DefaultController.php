<?php

namespace CmsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use CmsBundle\Entity\Content;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $title = "Hello world";
        $block = '{% block title %}'.$title.'{% endblock %}';

        $pos = $this->getParameter('positions');

        $databaseLoader = $this->container->get('cms.twig.loader');

        $loader = new \Twig_Loader_Chain(array($this->get('twig')->getLoader(), $databaseLoader));
        $this->get('twig')->setLoader($loader);
        
        //$databaseTwig = new \Twig_Environment($databaseLoader);

        //$blockLoader = new Twig_Loader_Array(array('base.html' => '{% block content %}{% endblock %}',));

        //$loader = new Twig_Loader_Chain(array($loader, $loader2));
/*        $template = $twig->createTemplate('hello {{ name }}');
        echo $template->render(array('name' => 'Fabien'));*/
        $myPage = 'CmsFrontBundle:Pages:home.html.twig';
        $template = $this->get('twig')->loadTemplate($myPage);
        $source = '{% extends "'.$myPage.'" %}';
        $source.='{% block title %}Hello{% endblock %}';
        
        $blocks = $template->getBlocks();
		$positions = array_keys($blocks);

      /*$blockTemplate = $twig->createTemplate("{% render(controller('CmsFrontBundle:BlogList:index', { 'max': 3})) %}");*/
//echo $blockTemplate->render(array());exit;

        //$template->setBlock('position1', $blockTemplate);
/*        $source = $template->getSource();
        $source .= '{% block title %} hello world {% endblock %}';
        //$source .= "{% block  %}{% render(controller('CmsFrontBundle:BlogList:index', { 'max': 3})) %}{% endblock %}";
        $main = $twig->createTemplate($source);*/


        // load modules in this page
        // $modules = $this->getDoctrine()->getManager()->getRepository('CmsBundle:Module')->findBy(array('context' => 'cms_front_homepage', 'position' => $positions));
        $contents = $this->getDoctrine()->getManager()->getRepository('CmsBundle:Content')->findBy(array('position' => $positions));
        foreach ($contents as $content) {
            $source .= $this->getContentSource($content);
        }

        $main = $this->get('twig')->createTemplate($source);
        
        $response = new Response();
        $response->setContent($main->render(array()));
        return $response;

        /*$blocks = $template->getParent(array())->getParent(array())->getBlocks();*/
        // $blocks[0] = $twig->createTemplate('hello world');

/*        var_dump(array_keys($blocks));
        var_dump($blocks[0]->getParent());die;
        echo $template->render(array('title', 'jhgqjsdqjsdgjqsgdqgsdqsdh'));exit;*/
        //$titleBlock = $template->renderBlock('title', array('test' => 'test'));
        //return $this->render();

        return $this->render('CmsFrontBundle:Pages:home.html.twig');
    }

    public function contentAction()
    {
        $templateFile = $this->getRequest()->attributes->has('templateFile') ? $this->getRequest()->attributes->get('templateFile') : 'CmsFrontBundle:Pages:empty.html.twig';

    	return $this->render($templateFile, array());
    }

    public function getContentSource(Content $content)
    {
        $source = '';
        $position = $content->getPosition();
        $params = $content->getParams() ? @json_decode($content->getParams()) : null;

        if ($position) {
            $source .= "{% block ".$position." %}";
        }

        if ($content->getTwigTemplate()) {
            $source .= $this->get('twig')->render($content->getTwigTemplate()->getName());
        } elseif ($params) {
            $params->controller = isset($params->controller) ? $params->controller : 'CmsFrontBundle:Default:content';
            $source .= "{% render(controller('".$params->controller."', ".json_encode($params).")) %}";
        }

        if ($position) {
            $source .= "{% endblock %}";
        }

        return $source;
    }
}
