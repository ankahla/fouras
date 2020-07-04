<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Couple
{
    protected $id;

    /**
     * @var User
     */
    private $user;

    private $husband;

    private $wife;

    private $weddingCity;

    /**
     * @var \DateTime $weddingDate
     *
     */
    private $weddingDate;

    private $urls;

    private $budgets;

    private $guests;

    function __construct()
    {
        $this->husband = new Husband;
        $this->wife = new Wife;
        $this->urls = new ArrayCollection;
        $this->budgets = new ArrayCollection;
        $this->guests = new ArrayCollection;
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
    
    public function getHusband()
    {
        return $this->husband;
    }

    public function setHusband($husband)
    {
       $this->husband = $husband;
       return $this;
    }

    public function getWife()
    {
        return $this->wife;
    }
    public function setWife($wife)
    {
        $this->wife = $wife;
        return $this;
    }

    public function getWeddingCity()
    {
        return $this->weddingCity;
    }
    
    public function setWeddingCity($weddingCity)
    {
        $this->weddingCity = $weddingCity;
        return $this;
    }
    
    public function getWeddingDate()
    {
        return $this->weddingDate;
    }
    
    public function setWeddingDate($weddingDate)
    {
        $this->weddingDate = $weddingDate;
        return $this;
    }

    public function addUrl(CoupleUrl $coupleUrl)
    {
        $coupleUrl->setCouple($this);
        $this->urls[] = $coupleUrl;

        return $this;
    }

    public function removeUrl(CoupleUrl $coupleUrl)
    {
        $this->urls->removeElement($coupleUrl);
    }

    public function getUrls()
    {
        return $this->urls;
    }
    
    public function setUrls($urls)
    {
        $this->urls = $urls;
        return $this;
    }
    public function getBudgets()
    {
        return $this->budgets;
    }

    public function addBudget(Budget $budget)
    {
        $budget->setCouple($this);
        $this->budgets[] = $budget;

        return $this;
    }

    public function removeBudget(Budget $budget)
    {
        $this->budgets->removeElement($budget);
    }

    public function setGuests(ArrayCollection $guests)
    {
        $this->guests = $guests;

        return $this;
    }

    public function getGuests()
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest)
    {
        $guest->setCouple($this);
        $this->guests[] = $guest;

        return $this;
    }

    public function removeGuest(Guest $guest)
    {
        $this->guests->removeElement($guest);
    }

    public function __toString()
    {
        return $this->user->getFirstName() . ' ' . $this->user->getLastName();
    }
}
