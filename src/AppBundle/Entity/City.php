<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class City
{
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

    /**
     * @Assert\NotBlank(message="Please enter a zipcode.")
     * @Assert\Length(
     *     min=3,
     *     max=10,
     *     minMessage="zipcode is too short.",
     *     maxMessage="zipcode is too long.",
     *     groups={"Profile"}
     * )
     */
    protected $zipcode;

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


    public function getZipcode()
    {
        return $this->zipcode;
    }
    
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function __toString()
    {
    	return $this->name;
    }

}