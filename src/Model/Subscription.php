<?php

namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Model\Traits\TimestampableTrait;

class Subscription
{
    use TimestampableTrait;

    protected $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var SubscriptionPlan
     */
    protected $plan;

    private bool $active;

    /**
     * @var \DateTime
     */
    protected $startAt;

    /**
     * @var \DateTime
     */
    protected $endAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
        $this->active = false;
    }

    /**
     * @return int
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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return null|SubscriptionPlan
     */
    public function getPlan(): ?SubscriptionPlan
    {
        return $this->plan;
    }

    /**
     * @param SubscriptionPlan $plan
     *
     * @return self
     */
    public function setPlan(SubscriptionPlan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->endAt < new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getStartAt(): \DateTime
    {
        return $this->startAt ?? new \DateTime();
    }

    /**
     * @param \DateTime $startAt
     *
     * @return self
     */
    public function setStartAt(\DateTime $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    /**
     * @param \DateTime $endAt
     *
     * @return self
     */
    public function setEndAt(\DateTime $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

}
