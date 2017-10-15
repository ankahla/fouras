<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="couple_url")
 */
class CoupleUrl
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
     * @ORM\ManyToOne(targetEntity="Couple", inversedBy="urls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couple;

    function __construct($type = 'facebook', $url = '')
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