<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;

class MainmenuController extends AbstractController
{
    /**
     * @Route("/mainmenu", name="mainmenu")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $isConnected = $user instanceof User;

        $userMenu = [
            'label' =>'My wedding',
            'sub' => [
                'fos_user_profile_show' => ['label' => 'Couple profile'],
                'couple_budget' => ['label' => 'Budget Planner'],
                'couple_todo' => ['label' => 'To Do List'],
                'couple_guestlist' => ['label' => 'Guest List'],
            ],
        ];

        if ($user instanceof User && $user->isVendor()) {
            $userMenu = [
                'label' =>'Dashboard',
                'sub' => [
                    'fos_user_profile_show' => ['label' => 'Profile'],
                    'vendor_service' => ['label' => 'My Services'],
                    'vendor_todo' => ['label' => 'To Do List'],
                    'vendor_inquery' => ['label' => 'Couple inquery'],
                ],
            ];
        }

        $mainmenuItems = [
            'homepage' => ['label' => 'Home'],
            'fos_user_profile_show' => $userMenu,
            'vendors' => ['label' => 'Services'],
            'about' => [
                'label' => 'About us',
                'sub' => [
                    'about' => ['label' => 'About'],
                    'wedding_list' => ['label' => 'Real wedding Listing'],
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

        return $this->render('front/mainmenu.html.twig', [
            'mainmenuItems' => $mainmenuItems,
            'logo' => 'logo.png'
            ]
        );
    }
}
