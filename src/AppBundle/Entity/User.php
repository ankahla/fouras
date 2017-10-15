<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Profile"}
     * )
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $address;

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
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="UserType")
     * @ORM\JoinColumn(name="user_type_id", referencedColumnName="id")
     */
    private $userType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $profilePicture;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user", cascade={"persist"})
     */
    private $tasks;

    function __construct()
    {
        parent::__construct();
        $this->tasks = new ArrayCollection;
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
    
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
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

    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getUserType()
    {
        return $this->userType;
    }
    
    public function setUserType($userType)
    {
        $this->userType = $userType;
        return $this;
    }

    public function isVendor()
    {
        if ($this->userType) {
            return $this->userType->getId() == UserType::VENDOR_TYPE;
        }

        return false;
    }

    public function isCouple()
    {
        if ($this->userType) {
            return $this->userType->getId() == UserType::COUPLE_TYPE;
        }

        return false;
    }
    
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
    
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
        return $this;
    }

    public function addTask(Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    public function removeTask(Task $task)
    {
        $this->tasks->removeElement($task);
    }

    public function getTasks()
    {
        return $this->tasks;
    }
}
