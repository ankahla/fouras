<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class BudgetItem
{
    protected $id;

    private $budget;

    /**
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

    protected $estimatedAmount = 0.0;

    protected $actuelAmount = 0;

    protected $paidAmount = 0;

    /**
     * @return mixed
     */
    public function getId()
    {
    	return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id): self
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
     * @param Budget $budget
     *
     * @return self
     */
    public function setBudget(Budget $budget)
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
     * @param string $name
     *
     * @return self
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
     * @param float $estimatedAmount
     *
     * @return self
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
     * @param int $actuelAmount
     *
     * @return self
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
     * @param int $paidAmount
     *
     * @return self
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
