<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Traits\PersonTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="vendor")
 */
class Vendor
{
    use PersonTrait;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="VendorUrl", mappedBy="vendor", cascade={"persist"})
     */
    private $urls;

    /**
     * @ORM\OneToMany(targetEntity="VendorService", mappedBy="vendor", cascade={"persist"})
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Enquiry", mappedBy="vendor", cascade={"persist", "remove"})
     */
    private $enquiries;

    function __construct()
    {
        $this->urls = new ArrayCollection;
        $this->services = new ArrayCollection;
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
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser($user)
    {
        $this->user = $user;

        if (!$this->email && $user->getEmail()) {
            $this->email = $user->getEmail();
        }

        if (!$this->firstName && !$this->lastName) {
            $this->firstName = $user->getFirstName();
            $this->lastName = $user->getLastName();
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

    public function addUrl(VendorUrl $vendorUrl)
    {
        $vendorUrl->setVendor($this);
        $this->urls[] = $vendorUrl;

        return $this;
    }

    public function removeUrl(VendorUrl $vendorUrl)
    {
        $this->urls->removeElement($vendorUrl);
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
    
    public function getServices()
    {
        return $this->services;
    }
    
    public function setServices($services)
    {
        $this->services = $services;
        return $this;
    }

    public function addService(VendorService $service)
    {
        if (!$service->getCity() && $this->getCity()) {
            $service->setCity($this->getCity());
        }

        $this->services[] = $service;

        return $this;
    }

    public function removeService(VendorService $service)
    {
        $this->services->removeElement($service);
    }

    public function setEnquiries($enquiries)
    {
        $this->enquiries = $enquiries;
        return $this;
    }

    public function addEnquiry(Enquiry $enquiry)
    {
        $this->enquiries[] = $enquiry;

        return $this;
    }

    public function removeEnquiry(Enquiry $enquiry)
    {
        $this->enquiries->removeElement($enquiry);
    }
}
