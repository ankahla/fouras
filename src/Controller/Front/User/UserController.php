<?php

namespace Controller\Front\User;

use Form\ServiceType;
use Form\UserParamsType;
use Model\User;
use Services\FileManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Model\Vendor;
use Model\Couple;
use Model\CoupleUrl;
use Model\VendorUrl;
use Model\Task;
use Form\VendorType;
use Form\CoupleType;
use Form\ProfilePictureFormType;

class UserController extends AbstractController
{
    public function preferences(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $userParams = $user->getUserParams();
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createForm(UserParamsType::class, $userParams);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($userParams);
            $user->setUserParams($userParams);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_preferences');
        }

        return $this->render('front/user/preferences.html.twig', [
            'edit_form' => $editForm->createView()
        ]);
    }

    public function createUrl(Request $request)
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
                // $form->getErrors(true, false);
            }

            return $this->redirectToRoute('fos_user_profile_show');
        }
    }

    public function deleteUrl($id)
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
    public function deleteTask(Request $request, Task $task)
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

    public function pictureUpload(Request $request, FileManager $fileManager)
    {
        $user = $this->getUser();
        $profilePictureForm = $this->createForm(ProfilePictureFormType::class, $user);

        $currentFileName = (string) $user->getProfilePicture();
        $profilePictureForm->handleRequest($request);

        if ($profilePictureForm->isSubmitted() && $profilePictureForm->isValid()) {
            $fileManager->setTargetDirectory($this->getParameter('profile_pic_dir'));
            $image = $profilePictureForm->get('profilePictureFile')->getData();

            if ($image && $fileName = $fileManager->upload($image)) {
                $fileManager->delete($currentFileName);
                // save user in db
                $em = $this->getDoctrine()->getManager();
                $user->setProfilePicture($fileName);
                $em->persist($user);
                $em->flush();
            } else {
                return new Response('File too big');
            }
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
