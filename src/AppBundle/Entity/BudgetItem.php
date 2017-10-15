<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="budget_item")
 */
class BudgetItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Budget", inversedBy="items")
     * @ORM\JoinColumn(name="budget_id", referencedColumnName="id")
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255)
     *
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
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     *
     */
    protected $estimatedAmount = 0.0;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     *
     */
    protected $actuelAmount = 0;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     *
     */
    protected $paidAmount = 0;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=3, nullable=true)
     *
     */
    protected $dueAmount = 0;


    public function getId()
    {
    	return $this->id;
    }

    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }

    public function getBudget()
    {
        return $this->budget;
    }
    
    public function setBudget($budget)
    {
        $this->budget = $budget;
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

    public function getEstimatedAmount()
    {
        return $this->estimatedAmount;
    }
    
    public function setEstimatedAmount($estimatedAmount)
    {
        $this->estimatedAmount = $estimatedAmount;
        return $this;
    }
    
    public function getActuelAmount()
    {
        return $this->actuelAmount;
    }
    
    public function setActuelAmount($actuelAmount)
    {
        $this->actuelAmount = $actuelAmount;
        return $this;
    }
    
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }
    
    public function setPaidAmount($paidAmount)
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }
    
    public function getDueAmount()
    {
        $toPay = $this->actuelAmount != 0.0 ? $this->actuelAmount : $this->estimatedAmount;

        return $toPay - $this->paidAmount;
    }
    
    public function setDueAmount($dueAmount)
    {
        $this->dueAmount = $dueAmount;
        return $this;
    }
    
    public function __toString()
    {
    	return $this->name;
    }
}
