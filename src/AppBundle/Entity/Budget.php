<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="budget")
 */
class Budget
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Couple")
     * @ORM\JoinColumn(name="couple_id", referencedColumnName="id")
     */
    private $couple;

    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="BudgetItem", mappedBy="budget", cascade={"persist"})
     */
    private $items;

    private $totals;

    function __construct()
    {
        $this->items = new ArrayCollection();
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
    
    public function getCouple()
    {
        return $this->couple;
    }
    
    public function setCouple($couple)
    {
        $this->couple = $couple;
        return $this;
    }
    
    public function getService()
    {
        return $this->service;
    }
    
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
    
    public function getItems()
    {
        return $this->items;
    }
    
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    public function addItem(BudgetItem $item)
    {
        //$item->setBudget($this);
        $this->items[] = $item;

        return $this;
    }

    public function removeTask(BudgetItem $item)
    {
        $this->items->removeElement($item);
    }

    public function getTotals()
    {
        if (empty($this->totals)) {

            $this->totals = [
                    'estimated' => 0,
                    'actuel' => 0,
                    'paid' => 0,
                    'due' => 0,
            ];

            if ($this->items->count()) {
                foreach ($this->items as $item) {
                    $this->totals['estimated'] += $item->getEstimatedAmount();
                    $this->totals['actuel'] += $item->getActuelAmount();
                    $this->totals['paid'] += $item->getPaidAmount();
                    $this->totals['due'] += $item->getDueAmount();
                }
            }
        }

        return $this->totals;
    }

    public function __toString()
    {
        if ($this->service) {
    	   return $this->service->getName();
        }

        return '';
    }

}