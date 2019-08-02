<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="url")
 */
class Url
{
    public const FB_TYPE = 'facebook',
    TW_TYPE = 'twitter',
    YT_TYPE = 'youtube',
    IN_TYPE = 'linkedin',
    IG_TYPE = 'instagram',
    X_TYPE = 'other';
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $type;


    public function getId()
    {
    	return $this->id;
    }

    public function setId($id)
    {
    	$this->id = $id;
    	return $this;
    }


    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function __toString()
    {
        return $this->url;
    }
}
