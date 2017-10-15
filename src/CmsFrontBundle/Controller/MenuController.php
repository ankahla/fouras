<?php

namespace CmsFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        $max = $this->getRequest()->attributes->has('max') ? $this->getRequest()->attributes->get('max') : 10;
        $id = $this->getRequest()->attributes->has('id') ? $this->getRequest()->attributes->get('id') : 1;
        $templateFile = $this->getRequest()->attributes->has('templateFile') ? $this->getRequest()->attributes->get('templateFile') : 'CmsFrontBundle:menu:default.html.twig';

        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('CmsBundle:Menu')->find($id);
        $items = $em->getRepository('CmsBundle:MenuItem')->findBy(array('menu' => $menu, 'parent' => null), array('ordering' => 'ASC'), $max);
        //$items[0].setActive(true);

        return $this->render($templateFile, array('items' => $items));
    }
}
