<?php
namespace Model;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class User extends \FOS\UserBundle\Model\User
{
    protected $id;

    protected $groups;

    /**
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

    protected $address;

    /**
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

    private $city;

    /**
     * @var UserType
     */
    private $userType;

    protected $profilePicture;

    /**
     * @var File
     */
    protected $profilePictureFile;

    private $tasks;

    public function __construct()
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
        return $this->userType->getId() == UserType::VENDOR_TYPE;
    }

    public function isCouple()
    {
        return $this->userType->getId() == UserType::COUPLE_TYPE;
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

    /**
     * @return File
     */
    public function getProfilePictureFile(): File
    {
        return $this->profilePictureFile ?? new File($this->profilePicture, false);
    }

    /**
     * @param File $profilePictureFile
     *
     * @return self
     */
    public function setProfilePictureFile(File $profilePictureFile): self
    {
        $this->profilePictureFile = $profilePictureFile;

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
