<?php
namespace Model;

class Url implements \Stringable
{
    public const FB_TYPE = 'facebook',
    TW_TYPE = 'twitter',
    YT_TYPE = 'youtube',
    IN_TYPE = 'linkedin',
    IG_TYPE = 'instagram',
    X_TYPE = 'other';

    protected $id;

    protected $url;

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

    public function __toString(): string
    {
        return (string) $this->url;
    }
}
