<?php

namespace CmsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('CmsFrontBundle:itemList:itemList.html.twig');
    }

    public function listAction($id = null, $slug = null, $page = null, $max = null)
    {
        $templateFile = $this->getRequest()->attributes->has('templateFile') ? $this->getRequest()->attributes->get('templateFile') : 'CmsFrontBundle:itemList:itemList.html.twig';
        $max = $this->getRequest()->attributes->has('max') ? $this->getRequest()->attributes->get('max') : 3;
        $id = $this->getRequest()->attributes->has('id') ? $this->getRequest()->attributes->get('id') : 1;

        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('CmsBundle:Category')->find($id);
        $items = $em->getRepository('CmsBundle:Item')->findBy(array('category' => $cat), null, $max);

        return $this->render($templateFile, array('items' => $items, 'category' => $cat));
    }

}
