<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserType
{
	public const COUPLE_TYPE = 1;
	public const VENDOR_TYPE = 2;
	
    protected $id;

    /**
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    protected $name;

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

    public function __toString()
    {
    	return $this->name;
    }

}