<?php

namespace Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Model\User;
use Symfony\Contracts\Translation\TranslatorInterface;

class MainmenuController extends AbstractController
{
    /**
     * @Route("/mainmenu", name="mainmenu")
     */
    public function index(TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $isConnected = $user instanceof User;

        $userMenu = [
            'label' => $translator->trans('My wedding'),
            'sub' => [
                'fos_user_profile_show' => ['label' => $translator->trans('Couple profile')],
                'couple_budget' => ['label' => $translator->trans('Budget Planner')],
                'couple_todo' => ['label' => $translator->trans('To Do List')],
                'couple_guestlist' => ['label' => $translator->trans('Guest List')],
            ],
        ];

        if ($user instanceof User && $user->isVendor()) {
            $userMenu = [
                'label' => $translator->trans('Dashboard'),
                'sub' => [
                    'fos_user_profile_show' => ['label' => $translator->trans('Profile')],
                    'vendor_service' => ['label' => $translator->trans('My Services')],
                    'vendor_todo' => ['label' => $translator->trans('To Do List')],
                    'vendor_enquiry' => ['label' => $translator->trans('Received enquiries')],
                ],
            ];
        }

        $mainmenuItems = [
            'homepage' => ['label' => $translator->trans('Home')],
            'fos_user_profile_show' => $userMenu,
            'vendors' => ['label' => $translator->trans('Services')],
            'about' => [
                'label' => $translator->trans('About us'),
                'sub' => [
                    'about' => ['label' => $translator->trans('About')],
                    'wedding_list' => ['label' => $translator->trans('Real wedding Listing')],
                ],
            ],
            'help' => [
                'label' => $translator->trans('Ideas & Advice'),
                'sub' => [
                    'faq' => ['label' => $translator->trans('Faq')],
                    'help' => ['label' => $translator->trans('Help')],
                ],
            ],
            'blog' => ['label' => $translator->trans('Blog')],
            'contact' => ['label' => $translator->trans('Contact us')],
        ];

        return $this->render(
            'front/mainmenu.html.twig',
            [
            'mainmenuItems' => $mainmenuItems,
            'logo' => 'logo.png'
            ]
        );
    }
}
