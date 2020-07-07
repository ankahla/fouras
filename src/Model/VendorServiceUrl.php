<?php
namespace Model;

class VendorServiceUrl
{
    protected $id;

    private $url;

    private $vendorService;

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

    public function getVendorService()
    {
        return $this->vendorService;
    }
    
    public function setVendorService($vendorService)
    {
        $this->vendorService = $vendorService;
        return $this;
    }
}
