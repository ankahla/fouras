<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

use AppBundle\Entity\Vendor;
use AppBundle\Entity\Couple;
use AppBundle\Entity\CoupleUrl;
use AppBundle\Entity\VendorUrl;
use AppBundle\Entity\Task;

use AppBundle\Form\VendorType;
use AppBundle\Form\CoupleType;
use AppBundle\Form\ProfilePictureFormType;
use Symfony\Component\HttpKernel\KernelInterface;

class UserController extends AbstractController
{
	public function createUrlAction(Request $request)
	{
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

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
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

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
    	$user = $this->getUser();

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

    public function pictureUploadAction(Request $request, KernelInterface $kernel)
    {
        $user = $this->getUser();

        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        $filePath = (string) $user->getProfilePicture();
        $profilePictureForm->handleRequest($request);

        if ($profilePictureForm->isSubmitted() && $profilePictureForm->isValid()) {
            $file = $user->getProfilePictureFile();

            if (!$file) {
                return new Response('File too big');
            }
            // remove old file
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid("", true)).'.'.$file->guessExtension();
            $filePath = $kernel->getProjectDir() . '/web/' . $this->getParameter('profile_pic_dir');

            // Move the file to the directory where profile pics are stored
            $file->move($filePath, $fileName);

            // save user in db
            $em = $this->getDoctrine()->getManager();
            $user->setProfilePicture($fileName);
            $em->persist($user);
            $em->flush();
        }

        return new Response();
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param Task $task The task entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
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
