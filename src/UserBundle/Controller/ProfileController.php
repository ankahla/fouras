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

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as profileBaseController;

use AppBundle\Entity\Vendor;
use AppBundle\Entity\Couple;
use AppBundle\Entity\Url;
use AppBundle\Entity\CoupleUrl;
use AppBundle\Entity\VendorUrl;
use AppBundle\Entity\UserType;
use AppBundle\Entity\Capacity;

use AppBundle\Form\VendorType;
use AppBundle\Form\CoupleType;
use AppBundle\Form\ProfilePictureFormType;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends profileBaseController
{
    use ControllerTrait;
    /**
     * Show the user
     */
    public function showAction()
    {
        return $this->mainProcess();
    }

    /**
     * Edit the user
     */
    public function editAction()
    {
        return $this->mainProcess();
    }

    /**
     * Edit the user
     */
    public function editProfileAction()
    {
        return $this->mainProcess();
    }

    private function mainProcess()
    {
        $userProfile = $this->getUserProfile();
        $user = $userProfile['user'];
        $request = $this->getRequest();

        $em = $this->container->get('Doctrine')->getEntityManager();
        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        if ($user->isVendor()) {
            $vendor = $userProfile['vendor'];
            $form = $this->createForm(VendorType::class, $vendor, ['method' => 'PATCH']);
        } else {
            $couple = $userProfile['couple'];
            $form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
        }

        $passwordForm = $this->container->get('fos_user.change_password.form');


        if ($request->isMethod('PATCH')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            } else {
                //die($form->getErrors());
            }

            return new RedirectResponse($this->getRedirectionUrl($user));
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
                'passwordForm' => $passwordForm->createView(),
            ]
        );
    }

    private function getUserProfile()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if ($user->getProfilePicture()) {
            $user->setProfilePicture(new File($user->getProfilePicture(), false));
        } else {
            $src = $this->container->get('app.gravatar_service')->getSrcByEmail($user->getEmail());
            $user->setProfilePicture(new File($src, false));
        }

        $userData = [
        'user' => $user,
        'couple' => null,
        'vendor' => null
        ];

        $em = $this->container->get('Doctrine')->getEntityManager();

        if ($user->isVendor()) {
            $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

            if (!$vendor) {
                $vendor = new Vendor;
                $vendor->setUser($user);
                $em->persist($vendor);
                $em->flush();
            }

            $userData['vendor'] = $vendor;
        } else {
            $couple = $em->getRepository(Couple::class)->findOneByUser($user);

            if (!$couple) {
                $em->persist($user);
                $couple->setUser($user);
                $em->persist($couple);
                $em->flush();
            }

            $userData['couple'] = $couple;
        }

        return $userData;
    }

    public function pictureUploadAction()
    {
        $userProfile = $this->getUserProfile();
        $user = $userProfile['user'];

        $em = $this->container->get('Doctrine')->getEntityManager();

        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        $request = $this->getRequest();
        $filePath = (string) $user->getProfilePicture();
        $profilePictureForm->handleRequest($request);

        if (
            $profilePictureForm->isSubmitted()
            && $profilePictureForm->isValid()
        ) {
            $file = $user->getProfilePicture();

            if (!$file) {
                return new Response('File too big');
            }
            // remove old file
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $filePath = $this->container->get('kernel')->getRootDir() .
                '/../web/' .
                $this->container->getParameter('profile_pic_dir');

            // Move the file to the directory where brochures are stored
            $file->move(
                $filePath,
                $fileName
            );

            $user->setProfilePicture($fileName);
            $em->persist($user);
            $em->flush();
        }

        return new Response;
    }

    /**
     * Generate the redirection url when editing is completed.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getRedirectionUrl(UserInterface $user)
    {
        return $this->container->get('router')->generate('fos_user_profile_show');
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }
}
