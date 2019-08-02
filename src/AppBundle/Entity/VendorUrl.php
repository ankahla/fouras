<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vendor_url")
 */
class VendorUrl
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Url", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="url_id", referencedColumnName="id")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="urls")
     * @ORM\JoinColumn(nullable=false)
     */
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