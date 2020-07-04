<?php
namespace AppBundle\Entity;

class CoupleUrl
{
    protected $id;

    private $url;

    private $couple;

    public function __construct($type = 'facebook', $url = '')
    {
        $this->url = new Url();
        $this->url
            ->setType($type)
            ->setUrl($url)
        ;
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
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getCouple()
    {
        return $this->couple;
    }
    
    public function setCouple($couple)
    {
        $this->couple = $couple;
        return $this;
    }
    
}