<?php 
/** 
* Class Gravatar 
* 
* From Gravatar Help: 
* "A gravatar is a dynamic image resource that is requested from our server. The request 
* URL is presented here, broken into its segments." 
* Source: 
* http://site.gravatar.com/site/implement 
* 
* @author Anouar Kahla <kahla.anouar@yahoo.fr> 
* @version 1.0 
* @package Gravatar 
*/ 

namespace AppBundle\Services;

class GravatarService
{ 
    /** 
     * Gravatar's url 
     */ 
    private const GRAVATAR_URL = "http://www.gravatar.com/avatar.php";

    /** 
     * Ratings available 
     */ 
    private $GRAVATAR_RATING = array("G", "PG", "R", "X");

    /** 
     * Query string. key/value 
     */ 
    protected $properties = array( 
        "gravatar_id" => NULL, 
        "default" => NULL, 
        "size" => 128,
        "rating" => NULL, 
        "border" => NULL, 
    );

    function __construct($options)
    {
        $this->properties = array_merge($this->properties, $options);
    }

    public function isValidEmail($email) { 
        return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email); 
    }

    /** 
     * Get source
     */ 
    public function getSrc($properties = [])
    {
        $properties = array_merge($this->properties, $properties);
        $properties['gravatar_id'] = urlencode(md5(strtolower($properties['gravatar_id'].'gh')));
        $properties['default'] = urlencode($properties['default']);

        return self::GRAVATAR_URL . "?" . http_build_query($properties);
    }

    /**
     * Get source
     */ 
    public function getSrcByEmail($email)
    {
        return $this->getSrc(['gravatar_id' => $email]);
    }
}
 