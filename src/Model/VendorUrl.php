<?php
namespace Model;

class VendorUrl
{
    protected $id;

    private $url;

    private $vendor;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getVendor()
    {
        return $this->vendor;
    }
    
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }
}
