<?php

namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Model\Traits\TimestampableTrait;

class Task
{
    use TimestampableTrait;

    protected $id;

    private $user;

    /**
     * @Assert\NotBlank(message="Please enter a valid name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The title is too short.",
     *     maxMessage="The title is too long.",
     * )
     */
    protected $title;

    protected $description;

    protected $date;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
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

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}
