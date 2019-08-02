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
     * @return mixed
     */
    public function getId()
    {
    	return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param $budget
     *
     * @return $this
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedAmount(): float
    {
        return $this->estimatedAmount;
    }

    /**
     * @param $estimatedAmount
     *
     * @return $this
     */
    public function setEstimatedAmount($estimatedAmount)
    {
        $this->estimatedAmount = $estimatedAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getActuelAmount(): int
    {
        return $this->actuelAmount;
    }

    /**
     * @param $actuelAmount
     *
     * @return $this
     */
    public function setActuelAmount($actuelAmount)
    {
        $this->actuelAmount = $actuelAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }

    /**
     * @param $paidAmount
     *
     * @return $this
     */
    public function setPaidAmount($paidAmount)
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getDueAmount()
    {
        $toPay = $this->actuelAmount != 0.0 ? $this->actuelAmount : $this->estimatedAmount;

        return $toPay - $this->paidAmount;
    }

    /**
     * @return string
     */
    public function __toString()
    {
    	return $this->name;
    }
}
