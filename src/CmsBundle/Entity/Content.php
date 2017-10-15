<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity
 */
class Content
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=50, nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="string", length=100, nullable=true)
     */
    private $context;

    /**
     * @var array
     *
     * @ORM\Column(name="params", type="json_array", length=65535, nullable=true)
     */
    private $params;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CmsBundle\Entity\TwigTemplate
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\TwigTemplate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="twig_template_id", referencedColumnName="id")
     * })
     */
    private $twigTemplate;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Content
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Content
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return Content
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set params
     *
     * @param array $params
     *
     * @return Content
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set twigTemplate
     *
     * @param \CmsBundle\Entity\TwigTemplate $twigTemplate
     *
     * @return Content
     */
    public function setTwigTemplate(\CmsBundle\Entity\TwigTemplate $twigTemplate = null)
    {
        $this->twigTemplate = $twigTemplate;

        return $this;
    }

    /**
     * Get twigTemplate
     *
     * @return \CmsBundle\Entity\TwigTemplate
     */
    public function getTwigTemplate()
    {
        return $this->twigTemplate;
    }

    public function __toString()
    {
        return $this->name;
    }
}
