<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Menu
 *
 * @ORM\Table(name="twig_template")
 * @ORM\Entity
 */
class TwigTemplate
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Menu
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getSource()
    {
        return $this->source;
    }
    
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    

    public function __toString()
    {
        return $this->name;
    }
}
