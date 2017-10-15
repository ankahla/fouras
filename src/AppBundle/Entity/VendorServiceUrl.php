<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vendor_service_url")
 */
class VendorServiceUrl
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
     * @ORM\ManyToOne(targetEntity="VendorService", inversedBy="urls")
     * @ORM\JoinColumn(nullable=false)
     */
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
        return $this->vendor;
    }
    
    public function setVendorService($vendorService)
    {
        $this->vendorService = $vendorService;
        return $this;
    }
    
}