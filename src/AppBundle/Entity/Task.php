<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task
{
    use TimestampableTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The title is too short.",
     *     maxMessage="The title is too long.",
     * )
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $description;

    /**
     * @ORM\Column(type="date")
     *
     */
    protected $date;

    function __construct()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \Datetime;
        }

        $this->updatedAt = new \Datetime;
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

    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    
    public function __toString()
    {
    	return $this->name;
    }

}