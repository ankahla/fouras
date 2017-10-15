<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="cover_image_id", columns={"cover_image_id"}), @ORM\Index(name="slug", columns={"slug"})})
 * @ORM\Entity
 */
class Item
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=150, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text", length=65535, nullable=true)
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="extra_data", type="text", length=65535, nullable=true)
     */
    private $extraData;

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
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CmsBundle\Entity\Media", inversedBy="item")
     * @ORM\JoinTable(name="item_media",
     *   joinColumns={
     *     @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     *   }
     * )
     */
    private $media;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->media = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Item
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
     * Set intro
     *
     * @param string $intro
     *
     * @return Item
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Item
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set extraData
     *
     * @param string $extraData
     *
     * @return Item
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    /**
     * Get extraData
     *
     * @return string
     */
    public function getExtraData()
    {
        return $this->extraData;
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
     * Set category
     *
     * @param \CmsBundle\Entity\Category $category
     *
     * @return Item
     */
    public function setCategory(\CmsBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CmsBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set coverImage
     *
     * @param \CmsBundle\Entity\Media $coverImage
     *
     * @return Item
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

    /**
     * Add medium
     *
     * @param \CmsBundle\Entity\Media $medium
     *
     * @return Item
     */
    public function addMedia(\CmsBundle\Entity\Media $medium)
    {
        $this->media[] = $medium;

        return $this;
    }

    /**
     * Remove medium
     *
     * @param \CmsBundle\Entity\Media $medium
     */
    public function removeMedia(\CmsBundle\Entity\Media $medium)
    {
        $this->media->removeElement($medium);
    }

    /**
     * Get media
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedia()
    {
        return $this->media;
    }

    public function __toString()
    {
        return $this->title;
    }
}
