<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainmenuController extends Controller
{
    /**
     * @Route("/mainmenu", name="mainmenu")
     */
    public function indexAction()
    {
        $mainmenuItems = [
            'homepage' => ['label' => 'Home'],
            'fos_user_profile_show' => [
                'label' =>'My wedding',
                'sub' => [
                    'fos_user_profile_show' => ['label' => 'Couple profile'],
                    'couple_budget' => ['label' => 'Budget Planner'],
                    'couple_todo' => ['label' => 'To Do List'],
                    'couple_guestlist' => ['label' => 'Guest List'],
                ],
            ],
            'vendors' => ['label' => 'Services'],
            'about' => [
                'label' => 'About us',
                'sub' => [
                    'about' => ['label' => 'About'],
                    'wedding_list' => ['label' => 'Real wedding Listing'],
                    'gallery' => ['label' => 'Gallery']
                ],
            ],
            'help' => [
                'label' => 'Ideas & Advice',
                'sub' => [
                    'faq' => ['label' => 'Faq'],
                    'help' => ['label' => 'Help'],
                ],
            ],
            'blog' => ['label' => 'Blog'],
            'contact' => ['label' => 'Contact us'],
        ];

        return $this->render('::front/mainmenu.html.twig', [
            'mainmenuItems' => $mainmenuItems,
            'logo' => 'logo.png'

            ]
        );
    }
}
