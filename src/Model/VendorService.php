<?php
namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class VendorService
{
    protected $id;

    /**
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The title is too short.",
     *     maxMessage="The title is too long.",
     * )
     */
    protected $title;

    private $service;

    private $vendor;

    private $city;

    /**
     * @Assert\Length(
     *     min=8,
     *     max=20,
     *     minMessage="The phone is invalid.",
     *     maxMessage="The phone is invalid.",
     *     groups={"Profile"}
     * )
     *
     */
    private $phone;

    private $costMin;

    private $costMax;

    /**
     * @Assert\Email(
     *     message = "The email is not valid.",
     * )
     */
    protected $email;

    protected $description;

    protected $address;

    protected $latitude;

    protected $longitude;

    protected $capacity;

    protected $picture;

    private $urls;

    private $youtubeVideoId;

    public function __construct()
    {
        $this->urls = new ArrayCollection;
        $this->costMin = 10;
        $this->costMax = 1000;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    public function getService()
    {
        return $this->service;
    }
    
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
    
    public function getVendor()
    {
        return $this->vendor;
    }
    
    public function setVendor(Vendor $vendor)
    {
        $this->vendor = $vendor;
        
        if (!$this->email) {
            $this->email = $vendor->getEmail();
        }

        if (!$this->city) {
            $this->city = $vendor->getCity();
        }
        
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
    
    public function getCostMin()
    {
        return $this->costMin;
    }
    
    public function setCostMin($costMin)
    {
        $this->costMin = $costMin;
        return $this;
    }
    
    public function getCostMax()
    {
        return $this->costMax;
    }
    
    public function setCostMax($costMax)
    {
        $this->costMax = $costMax;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }
    
    public function getCapacity()
    {
        return $this->capacity;
    }
    
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }
    
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    public function getYoutubeVideoId()
    {
        return $this->youtubeVideoId;
    }
    
    public function setYoutubeVideoId($youtubeVideoId)
    {
        $this->youtubeVideoId = $youtubeVideoId;

        return $this;
    }

    public function addUrl(VendorServiceUrl $vendorServiceUrl)
    {
        $vendorServiceUrl->setVendorService($this);
        $this->urls[] = $vendorServiceUrl;

        return $this;
    }

    public function removeUrl(VendorServiceUrl $vendorServiceUrl)
    {
        $this->urls->removeElement($vendorServiceUrl);
    }

    public function getUrls()
    {
        return $this->urls;
    }

    public function setUrls($urls)
    {
        $this->urls = $urls;
        return $this;
    }
}
