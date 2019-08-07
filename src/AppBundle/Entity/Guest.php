<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\PersonTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="guest")
 */
class Guest
{
    use PersonTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Couple")
     * @ORM\JoinColumn(name="couple_id", referencedColumnName="id")
     */
    private $couple;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
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
