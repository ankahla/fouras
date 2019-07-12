<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="enquiry")
 */
class Enquiry
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Email(
     *     message = "The email is not valid.",
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
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
     * @ORM\ManyToOne(targetEntity="Couple")
     * @ORM\JoinColumn(name="couple_id", referencedColumnName="id", nullable=false)
     */
    private $couple;

    /**
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="enquiries")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @ORM\ManyToOne(targetEntity="VendorService")
     * @ORM\JoinColumn(name="vendor_service_id", referencedColumnName="id", nullable=false)
     */
    private $vendorService;

    /**
     * @var date $weddingDate
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $weddingDate;

    /**
     * @var date $phoneCallBack
     *
     * @ORM\Column(type="boolean", nullable=true, options={"default" : true})
     */
    private $phoneCallBack;

    /**
     * @var date $emailResponseBack
     *
     * @ORM\Column(type="boolean", nullable=true, options={"default" : true})
     */
    private $emailResponseBack;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
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

    public function getPhone()
    {
        return $this->phone;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
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

    public function getCouple()
    {
        return $this->couple;
    }
    
    public function setCouple($couple)
    {
        $this->couple = $couple;
        
        if (!$this->email) {
            $this->email = $couple->getUser()->getEmail();
        }

        if (!$this->name) {
            $this->name = $couple->getUser()->getFirstName() . ' ' . $couple->getUser()->getLastName();
        }

        if (!$this->phone) {
            $this->phone = $couple->getUser()->getPhone() ? $couple->getUser()->getPhone() : $couple->getUser()->getMobile();
        }

        if (!$this->weddingDate) {
            $this->weddingDate = $couple->getWeddingDate();
        }
        
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

    public function getWeddingDate()
    {
        return $this->weddingDate;
    }
    
    public function setWeddingDate($weddingDate)
    {
        $this->weddingDate = $weddingDate;
        return $this;
    }

    public function getPhoneCallBack()
    {
        return $this->phoneCallBack;
    }
    
    public function setPhoneCallBack($phoneCallBack)
    {
        $this->phoneCallBack = $phoneCallBack;

        return $this;
    }

    public function getemailResponseBack()
    {
        return $this->emailResponseBack;
    }
    
    public function setemailResponseBack($emailResponseBack)
    {
        $this->emailResponseBack = $emailResponseBack;

        return $this;
    }
}