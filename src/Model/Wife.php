<?php
namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Model\Traits\PersonTrait;

class Wife
{
    use PersonTrait;

    /**
     * @Assert\NotBlank(message="Please enter a name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     * )
     */
    protected $fatherName;

    /**
     * @Assert\NotBlank(message="Please enter a name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long."
     * )
     */
    protected $motherName;


    public function getFatherName()
    {
        return $this->fatherName;
    }
    
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;
        return $this;
    }
    
    public function getMotherName()
    {
        return $this->motherName;
    }
    
    public function setMotherName($motherName)
    {
        $this->motherName = $motherName;
        return $this;
    }
}
