<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

use AppBundle\Entity\Vendor;
use AppBundle\Entity\Couple;
use AppBundle\Entity\Url;
use AppBundle\Entity\CoupleUrl;
use AppBundle\Entity\VendorUrl;
use AppBundle\Entity\Task;

use AppBundle\Form\VendorType;
use AppBundle\Form\CoupleType;
use AppBundle\Form\ProfilePictureFormType;

class UserController extends Controller
{
	public function createUrlAction(Request $request)
	{
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->get('Doctrine')->getEntityManager();

		if ($user->isVendor()) {
			$vendor = $em->getRepository(Vendor::class)->findOneByUser($user);
			$vendor->addUrl(new VendorUrl);
			$form = $this->createForm(VendorType::class, $vendor, ['method' => 'PATCH']);
		} else {
			$couple = $em->getRepository(Couple::class)->findOneByUser($user);
			$couple->addUrl(new CoupleUrl);
			$form = $this->createForm(CoupleType::class, $couple, ['method' => 'PATCH']);
		}

		if ($request->isMethod('PATCH')) {

			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$em->flush();
			} else {
				die($form->getErrors(true, false));
			}

			return $this->redirectToRoute('fos_user_profile_show');
		}
	}

    public function deleteUrlAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->container->get('Doctrine')->getEntityManager();

        if ($user->isVendor()) {
        	$vendor = $em->getRepository(Vendor::class)->findOneByUser($user);
        	$url = $em->getRepository(VendorUrl::class)->findOneBy(['vendor' => $vendor, 'id' => $id]);
        } else {
        	$couple = $em->getRepository(Couple::class)->findOneByUser($user);
        	$url = $em->getRepository(CoupleUrl::class)->findOneBy(['couple' => $couple, 'id' => $id]);
        }

        if ($url) {
            $em->remove($url);
            $em->flush();
        }

        return $this->redirectToRoute('fos_user_profile_show');
    }

    /**
     * Deletes a task entity.
     *
     */
    public function deleteTaskAction(Request $request, Task $task)
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();

        $form = $this->createDeleteTaskForm($task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }

        if ($user->isVendor()) {
        	return $this->redirectToRoute('vendor_todo');
        }

        return $this->redirectToRoute('couple_todo');
    }

    public function pictureUploadAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user->getProfilePicture()) {
        	$user->setProfilePicture(new File($user->getProfilePicture(), false));
        } else {
        	$src = $this->container->get('app.gravatar_service')->getSrcByEmail($user->getEmail());
        	$user->setProfilePicture(new File($src, false));
        }

        $em = $this->get('Doctrine')->getEntityManager();

        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        $profilePictureForm->handleRequest($request);
        if (
            $profilePictureForm->isSubmitted()
            && $profilePictureForm->isValid()
        ) {
            $file = $user->getProfilePicture();
            if (!$file) {
                return new Response('File too big');
            }
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $filePath = $this->container->get('kernel')->getRootDir() .
                '/../web/' .
                $this->container->getParameter('profile_pic_dir');

            // Move the file to the directory where profile picture are stored
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
     * Creates a form to delete a task entity.
     *
     * @param Task $task The task entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteTaskForm(Task $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete_task', array('id' => $task->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
