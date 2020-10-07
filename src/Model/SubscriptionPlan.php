<?php

namespace Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class SubscriptionPlan
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
    protected string $name;

    protected ?string $description;

    protected float $monthlyPrice = 0.0;

    private bool $inPromotion = false;

    private bool $popular = false;

    private bool $public = true;

    /**
     * @var ArrayCollection
     */
    private $features;

    public function __construct()
    {
        $this->features = new ArrayCollection([]);
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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
     * @return float
     */
    public function getMonthlyPrice(): float
    {
        return $this->monthlyPrice;
    }

    /**
     * @param float $monthlyPrice
     *
     * @return self
     */
    public function setMonthlyPrice(float $monthlyPrice): self
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInPromotion(): bool
    {
        return $this->inPromotion;
    }

    /**
     * @param bool $inPromotion
     *
     * @return self
     */
    public function setInPromotion(bool $inPromotion): self
    {
        $this->inPromotion = $inPromotion;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPopular(): bool
    {
        return $this->popular;
    }

    /**
     * @param bool $popular
     *
     * @return self
     */
    public function setPopular(bool $popular): self
    {
        $this->popular = $popular;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param ArrayCollection $features
     *
     * @return self
     */
    public function setFeatures($features): self
    {
        $this->features = $features;

        return $this;
    }

    public function getInPromotion(): ?bool
    {
        return $this->inPromotion;
    }

    public function getPopular(): ?bool
    {
        return $this->popular;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     *
     * @return self
     */
    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function addFeature(SubscriptionFeature $feature): self
    {
        if (!$this->features->contains($feature)) {
            $this->features[] = $feature;
        }

        return $this;
    }

    public function removeFeature(SubscriptionFeature $feature): self
    {
        if ($this->features->contains($feature)) {
            $this->features->removeElement($feature);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
