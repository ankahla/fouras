<?php

namespace Model;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

class Capacity implements Translatable, \Stringable
{
    protected $id;

    #[Assert\NotBlank(message: 'Please enter a valid name.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'The name is too short.', maxMessage: 'The name is too long.')]
    #[Gedmo\Translatable]
    protected $name;

    #[Gedmo\Locale] // Used locale to override Translation listener`s locale
    private $locale;

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

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}
