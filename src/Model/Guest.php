<?php
namespace Model;

use Model\Traits\PersonTrait;

class Guest
{
    use PersonTrait;

    private $couple;

    protected $description;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
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

    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
