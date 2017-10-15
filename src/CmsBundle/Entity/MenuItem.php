<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItem
 *
 * @ORM\Table(name="menu_item", indexes={@ORM\Index(name="menu_id", columns={"menu_id"}), @ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class MenuItem
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true)
     */
    private $ordering = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=50, nullable=true)
     */
    private $class;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    private $active;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="CmsBundle\Entity\MenuItem", mappedBy="parent")
     */
    private $children;


    /**
     * @var \CmsBundle\Entity\MenuItem
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\MenuItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \CmsBundle\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     * })
     */
    private $menu;

    /**
     * @var \CmsBundle\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\Content")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     * })
     */
    private $content;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return MenuItem
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
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return MenuItem
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return MenuItem
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
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
     * Add child
     *
     * @param \CmsBundle\Entity\MenuItem $child
     *
     * @return MenuItem
     */
    public function addChild(\CmsBundle\Entity\MenuItem $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \CmsBundle\Entity\MenuItem $child
     */
    public function removeChild(\CmsBundle\Entity\MenuItem $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set menu
     *
     * @param \CmsBundle\Entity\Menu $menu
     *
     * @return MenuItem
     */
    public function setMenu(\CmsBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \CmsBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set parent
     *
     * @param \CmsBundle\Entity\MenuItem $parent
     *
     * @return MenuItem
     */
    public function setParent(\CmsBundle\Entity\MenuItem $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \CmsBundle\Entity\MenuItem
     */
    public function getParent()
    {
        return $this->parent;
    }


    public function getActive()
    {
        return $this->active;
    }
    
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }


    public function getContent()
    {
        return $this->content;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
