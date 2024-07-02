<?php
namespace Model;

use Symfony\Component\Validator\Constraints as Assert;

class Enquiry
{
    private $id;

    #[Assert\NotBlank(message: 'Please enter a valid name.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'The name is too short.', maxMessage: 'The name is too long.')]
    private $name;

    #[Assert\Email(message: 'The email is not valid.')]
    private $email;

    
    #[Assert\Length(min: 8, max: 20, minMessage: 'The phone is invalid.', maxMessage: 'The phone is invalid.', groups: ['Profile'])]
    private $phone;

    /**
     * @var Couple
     */
    private $couple;

    /**
     */
    private $vendor;

    /**
     */
    private $vendorService;

    /**
     * @var \DateTime $weddingDate
     */
    private $weddingDate;

    /**
     * @var bool $phoneCallBack
     */
    private $phoneCallBack;

    /**
     * @var bool $emailResponseBack
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

    public function getVendor(): Vendor
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
    
    public function setCouple(Couple $couple)
    {
        $this->couple = $couple;
        
        if (!$this->email) {
            $this->email = $couple->getUser()->getEmail();
        }

        if (!$this->name) {
            $this->name = $couple->getUser()->getFirstName() . ' ' . $couple->getUser()->getLastName();
        }

        if (!$this->phone) {
            $this->phone = $couple->getUser()->getPhone() ?: $couple->getUser()->getMobile();
        }

        if (!$this->weddingDate instanceof \DateTime) {
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

    public function isPhoneCallBack()
    {
        return $this->phoneCallBack;
    }
    
    public function setPhoneCallBack($phoneCallBack)
    {
        $this->phoneCallBack = $phoneCallBack;

        return $this;
    }

    public function isEmailResponseBack()
    {
        return $this->emailResponseBack;
    }
    
    public function setemailResponseBack($emailResponseBack)
    {
        $this->emailResponseBack = $emailResponseBack;

        return $this;
    }
}
