<?php
namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class SearchVendorService
{
    private $service;

    private $vendor;

    private $city;

    private $costMin;

    private $costMax;

    protected $email;

    protected $description;

    protected $address;

    protected $capacity;

    public function __construct()
    {
        $this->costMin = 10;
        $this->costMax = 1000;
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

    public function getCapacity()
    {
        return $this->capacity;
    }
    
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }
}
