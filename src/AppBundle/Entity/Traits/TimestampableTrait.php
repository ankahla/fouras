<?php
namespace AppBundle\Entity\Traits;

use \datetime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TimestampableTrait
{
    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt(): datetime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
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
     * @return datetime
     */
    public function getUpdatedAt(): datetime
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}