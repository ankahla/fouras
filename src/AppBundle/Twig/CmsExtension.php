<?php
/** 
* class CmsExtension
* 
* @author Anouar Kahla <kahla.anouar@yahoo.fr> 
* @version 1.0 
* @package Gravatar 
*/ 

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

namespace AppBundle\Twig;

class CmsExtension extends Twig_Extension
{
	private $absoluteUrl;

	public function __construct($absoluteUrl)
	{
		$this->absoluteUrl = $absoluteUrl;
	}

    public function getFilters()
    {
        return array(
            new TwigFilter('image', array($this, 'getImage')),
        );
    }
/*    public function getFunctions()
    {
        return array(
            new Twig_Function('lipsum', 'generate_lipsum'),
        );
    }*/

    // ...

    public function getImage($uri)
    {
    	return $this->absoluteUrl.$uri;
    }
}