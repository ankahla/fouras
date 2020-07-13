<?php
namespace Model;

use Doctrine\Common\Collections\ArrayCollection;
use Model\Traits\PersonTrait;

class Vendor
{
    use PersonTrait;

    private $user;

    private $urls;

    private $services;

    private $city;

    /**
     * @var ArrayCollection
     */
    private $enquiries;

    public function __construct()
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
    
    public function getUser(): User
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

    public function canDisplayPhone(): bool
    {
        return !$this->getUser()->getUserParams()->isPhoneNumberHidden();
    }
}
