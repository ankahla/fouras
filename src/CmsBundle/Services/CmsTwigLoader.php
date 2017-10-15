<?php

namespace CmsBundle\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;

class CmsTwigLoader implements \Twig_LoaderInterface, \Twig_ExistsLoaderInterface
{
    protected $em;
    protected $tpls;

    public function __construct(Registry $registry)
    {
        $this->em = $registry->getManager();
    }

    public function getSource($name)
    {
        $tpl = $this->getTpl($name);
        if (!$tpl) {
            throw new \Twig_Error_Loader(sprintf('Template "%s" does not exist.', $name));
        }

        return $tpl->getSource();
    }

    // Twig_SourceContextLoaderInterface as of Twig 1.27
    public function getSourceContext($name)
    {
        $tpl = $this->getTpl($name);
        if (!$tpl) {
            throw new \Twig_Error_Loader(sprintf('Template "%s" does not exist.', $name));
        }

        return new \Twig_Source($tpl->getSource(), $name);
    }

    // Twig_ExistsLoaderInterface as of Twig 1.11
    public function exists($name)
    {
        $tpl = $this->getTpl($name);

        return $tpl ? true : false;
    }

    public function getCacheKey($name)
    {
        return md5($name);
    }

    public function isFresh($name, $time)
    {
        $tpl = $this->getTpl($name);
        if (!$tpl || !$tpl->getUpdatedAt() instanceof \DateTime) {
            return false;
        }

        return  $tpl->getUpdatedAt()->getTimestamp() <= $time;
    }

    protected function getTpl($name)
    {
        if (!isset($this->tpls[$name])) {
            $this->tpls[$name] = $this->em->getRepository('CmsBundle:TwigTemplate')->findOneByName($name);
        }

        return $this->tpls[$name];
    }
}