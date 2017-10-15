<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CmsBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \CmsBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cover_image_id", referencedColumnName="id")
     * })
     */
    private $coverImage;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set parent
     *
     * @param \CmsBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\CmsBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \CmsBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set coverImage
     *
     * @param \CmsBundle\Entity\Media $coverImage
     *
     * @return Category
     */
    public function setCoverImage(\CmsBundle\Entity\Media $coverImage = null)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * Get coverImage
     *
     * @return \CmsBundle\Entity\Media
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    public function __toString()
    {
        return $this->name;
    }
}
