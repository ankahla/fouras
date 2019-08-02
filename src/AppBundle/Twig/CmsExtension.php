<?php
/** 
* class CmsExtension
* 
* @author Anouar Kahla <kahla.anouar@yahoo.fr> 
* @version 1.0 
* @package Gravatar 
*/ 

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CmsExtension extends AbstractExtension
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