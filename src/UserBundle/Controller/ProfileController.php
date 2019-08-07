<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

use AppBundle\Entity\Vendor;
use AppBundle\Entity\Couple;

use AppBundle\Form\VendorType;
use AppBundle\Form\CoupleType;
use AppBundle\Form\ProfilePictureFormType;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends AbstractController
{
    /**
     * Show the user
     */
    public function showAction(Request $request)
    {
        return $this->mainProcess($request);
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        return $this->mainProcess($request);
    }

    /**
     * Edit the user
     */
    public function editProfileAction(Request $request)
    {
        return $this->mainProcess($request);
    }

    private function mainProcess(Request $request)
    {
        $userProfile = $this->getUserProfile();
        $user = $userProfile['user'];

        $em = $this->getDoctrine()->getManager();
        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        if ($user->isVendor()) {
            $vendor = $userProfile['vendor'];
            $form = $this->createForm(VendorType::class, $vendor, ['method' => 'PATCH']);
        } else {
            $couple = $userProfile['couple'];
            $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        }

        if ($request->isMethod('PATCH')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            } else {
                // @todo
                dump($form->getErrors());
            }

            return $this->redirectToRoute('fos_user_profile_show');
        }

        $template = $user->isVendor() ?
            'UserBundle:Profile/Vendor:profile.html.twig' :
            'UserBundle::Profile/Couple/profile.html.twig';

        return $this->render(
            $template,
            [
                'user' => $user,
                'profilePictureForm' => $profilePictureForm->createView(),
                'profileForm' => $form->createView(),
                'newUrlForm' =>  $form->createView(),
            ]
        );
    }

    private function getUserProfile()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();

        $userData = [
            'user' => $user,
            'couple' => $em->getRepository(Couple::class)->findOneByUser($user),
            'vendor' => $em->getRepository(Vendor::class)->findOneByUser($user),
        ];

        return $userData;
    }
}
