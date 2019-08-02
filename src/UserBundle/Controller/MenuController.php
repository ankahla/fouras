<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends AbstractController
{
    public function indexAction(Request $request, TranslatorInterface $translator)
    {
    	$user = $this->getUser();
        $currentRoute = $request->attributes->get('_route');

    	if ($user && $user->isVendor()) {
    		$menuItems = [
				'vendor_dashboard' 		=> $translator->trans('Dashboard'),
				'fos_user_profile_show' => $translator->trans('Profile'),
				'vendor_todo' 			=> $translator->trans('To Do List'),
				'vendor_service' 		=> $translator->trans('My Services'),
				//'vendor_inquery' 		=> $translator->trans('Couple inquery'),
    		];
    	} else {
    		$menuItems = [
	    		'fos_user_profile_show' 	=> $translator->trans('Profile'),
	    		'couple_todo' 				=> $translator->trans('To Do List'),
	    		'couple_budget' 			=> $translator->trans('My Budget'),
	    		//'couple_wishlist' 			=> $translator->trans('My Wishlist'),
	    		'couple_guestlist' 			=> $translator->trans('Guest List'),
	    		'fos_user_change_password' 	=> $translator->trans('Password'),
    		];
    	}

        return $this->render('UserBundle:Profile:menu.html.twig', ['menuitems' => $menuItems, 'currentRoute' => $currentRoute]);
    }
}
