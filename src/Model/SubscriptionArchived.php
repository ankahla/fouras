<?php

namespace Model;

class SubscriptionArchived
{
    protected $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var SubscriptionPlan
     */
    protected $plan;

    /**
     * @var \DateTime
     */
    protected $startAt;

    /**
     * @var \DateTime
     */
    protected $endAt;

    /**
     * @var \DateTime
     */
    protected $archivedAt;

    /**
     * @return \DateTime
     */
    public function getArchivedAt(): \DateTime
    {
        return $this->archivedAt;
    }

    /**
     * @param \DateTime $archivedAt
     *
     * @return self
     */
    public function setArchivedAt(\DateTime $archivedAt): self
    {
        $this->archivedAt = $archivedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return SubscriptionPlan
     */
    public function getPlan(): SubscriptionPlan
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
     * @return \DateTime
     */
    public function getStartAt(): \DateTime
    {
        return $this->startAt;
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
    public function getEndAt(): \DateTime
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
