<?php
namespace Model\Traits;

use \DateTime;
use Gedmo\Mapping\Annotation\Timestampable;

trait TimestampableTrait
{
    /**
     * @var DateTime $createdAt
     */
    #[Timestampable(on: 'create')]
    private $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[Timestampable(on: 'update')]
    private $updatedAt;


    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
