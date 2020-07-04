<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Service
{
     protected $id;

    /**
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    protected $name;

    protected $image;

    protected $mapIcon;

    protected $vendorServices;

    public function getId()
    {
    	return $this->id;
    }

    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
    
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getMapIcon()
    {
        return $this->mapIcon;
    }
    
    public function setMapIcon($mapIcon)
    {
        $this->mapIcon = $mapIcon;
        return $this;
    }

    public function getVendorServices()
    {
        return $this->vendorServices;
    }
    
    public function setVendorServices($vendorServices)
    {
        $this->vendorServices = $vendorServices;

        return $this;
    }
   
    public function __toString()
    {
    	return $this->name;
    }

}