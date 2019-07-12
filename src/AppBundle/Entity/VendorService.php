<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="vendor_service")
 */
class VendorService
{
    const CAPACITY_A = 'Inférieur à 50',
    CAPACITY_B = 'Entre 50 et 100',
    CAPACITY_C = 'Entre 100 et 200',
    CAPACITY_D = 'Entre 200 et 500',
    CAPACITY_E = 'Entre 500 et 1000',
    CAPACITY_F = 'Supérieur à 1000';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The title is too short.",
     *     maxMessage="The title is too long.",
     * )
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", nullable=false)
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="services")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
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

    /**
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     */
    private $costMin;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     */
    private $costMax;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Email(
     *     message = "The email is not valid.",
     * )
     */
    protected $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     */
    protected $latitude;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     */
    protected $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="Capacity")
     * @ORM\JoinColumn(name="capacity_id", referencedColumnName="id")
     */
    protected $capacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $picture;

    /**
     * @ORM\OneToMany(targetEntity="VendorServiceUrl", mappedBy="vendorService", cascade={"persist", "remove"})
     */
    private $urls;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     */
    private $youtubeVideoId;

    /**
     * @ORM\OneToMany(targetEntity="Enquiry", mappedBy="vendorService", cascade={"persist", "remove"})
     */
    private $enquiries;

    function __construct()
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
    
    public function setVendor($vendor)
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
