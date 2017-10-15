<?php
namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait PersonTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter a name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter a name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     * )
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Email(
     *     message = "The email is not valid.",
     * )
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(
     *     min=8,
     *     max=20,
     *     minMessage="The phone is invalid.",
     *     maxMessage="The phone is invalid.",
     *     groups={"Profile"}
     * )
     *
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(
     *     min=8,
     *     max=20,
     *     minMessage="The mobile phone is invalid.",
     *     maxMessage="The mobile phone is invalid.",
     *     groups={"Profile"}
     * )
     *
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $address;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
    
    public function getMobile()
    {
        return $this->mobile;
    }
    
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
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
    
    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }
}