<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Entity\Task;
use AppBundle\Entity\Vendor;
use AppBundle\Entity\VendorService;
use AppBundle\Entity\Url;
use AppBundle\Entity\VendorServiceUrl;
use AppBundle\Form\TaskType;
use AppBundle\Form\VendorServiceType;

class VendorController extends AbstractController
{

    public function dashboardAction()
    {
        return $this->render('UserBundle::Profile/Vendor/dashboard.html.twig');
    }

    public function inqueryAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

        return $this->render('UserBundle::Profile/Vendor/inquery.html.twig', ['vendor' => $vendor]);
    }

    public function serviceAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

        return $this->render('UserBundle::Profile/Vendor/services.html.twig', ['vendor' => $vendor]);
    }

    public function newServiceAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);
        $vendorService = new VendorService;
        $vendorService->setVendor($vendor);
        // youtube url
        $url = new Url();
        $url->setType(Url::YT_TYPE);
        $vendorServiceUrl = new VendorServiceUrl();
        $vendorServiceUrl->setUrl($url);
        $vendorService->addUrl($vendorServiceUrl);

        $form = $this->createForm(VendorServiceType::class, $vendorService, 
            [
                'method' => 'PATCH',
                'action' => $this->generateUrl('vendor_service_create'),
            ]
        );

        return $this->render(
            'UserBundle::Profile/Vendor/serviceForm.html.twig',
            ['vendorServiceForm' => $form->createView()]
        );
    }

    public function editServiceAction(Request $request, $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

        $vendorService = $em->getRepository(VendorService::class)->findOneBy(
            [
                'vendor' => $vendor,
                'id' => $id
            ]
        );

        if (!$vendorService) {
            throw $this->createNotFoundException('The service does not exist');
        }

        if ($vendorService->getPicture()) {
            $vendorService->setPicture(new File($vendorService->getPicture(), false));
        }

        $form = $this->createForm(VendorServiceType::class, $vendorService, 
            [
                'method' => 'PATCH',
                'action' => $this->generateUrl('vendor_service_update', ['id' => $id]),
            ]
        );

        return $this->render(
            'UserBundle::Profile/Vendor/serviceForm.html.twig',
            [
            'vendorServiceForm' => $form->createView(),
            'vendorService' => $vendorService,
            ]
        );
    }

    public function updateServiceAction(Request $request, $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

        $vendorService = $em->getRepository(VendorService::class)->findOneBy(
            [
                'vendor' => $vendor,
                'id' => $id
            ]
        );

        if (!$vendorService) {
            throw $this->createNotFoundException('The service does not exist');
        }

        if ($vendorService->getPicture()) {
            $vendorService->setPicture(new File($this->getParameter('vendor_service_pic_dir') . $vendorService->getPicture(), false));
        }

        $form = $this->createForm(VendorServiceType::class, $vendorService, 
            ['method' => 'PATCH']
        );

        if ($request->isMethod('POST') || $request->isMethod('PATCH')) {
            // picture filename
            $picturePath = (string) $vendorService->getPicture();
            $fileName = basename($picturePath);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if ($request->files->count()) {
                    // delete old file
                    if (file_exists($picturePath)) {
                        unlink($picturePath);
                    }
                    // upload file
                    $file = $vendorService->getPicture();
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid('', true)).'.'.$file->guessExtension();
                    // Move the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('vendor_service_pic_dir'),
                        $fileName
                    );
                }

                $vendorService->setPicture($fileName);
                $vendor->addService($vendorService);
                $em->persist($vendor);
                $em->flush();

                return $this->redirectToRoute('vendor_service');
            } else {
                /*var_dump($form->isValid());
                var_dump($form->getErrors());die;*/
            }
        }

        return $this->render(
            'UserBundle::Profile/Vendor/serviceForm.html.twig',
            [
            'vendorServiceForm' => $form->createView(),
            'vendorService' => $vendorService,
            ]
        );
    }

    public function createServiceAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);
        $vendorService = new VendorService;
        $vendorService->setVendor($vendor);
        // youtube url
        $url = new Url();
        $url->setType(Url::YT_TYPE);
        $vendorServiceUrl = new VendorServiceUrl();
        $vendorServiceUrl->setUrl($url);
        $vendorService->addUrl($vendorServiceUrl);

        $form = $this->createForm(VendorServiceType::class, $vendorService, ['method' => 'PATCH']);

        if ($request->isMethod('POST') || $request->isMethod('PATCH')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // upload file
                $file = $vendorService->getPicture();
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid('', true)).'.'.$file->guessExtension();
                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('vendor_service_pic_dir'),
                    $fileName
                );
                $vendorService->setPicture($fileName);
                $vendor->addService($vendorService);
                $em->persist($vendor);
                $em->flush();

                return $this->redirectToRoute('vendor_service');
            } else {
                var_dump($form->isValid());
                die($form->getErrors());
            }
        }

        return $this->render(
            'UserBundle::Profile/Vendor/serviceForm.html.twig',
            ['vendorServiceForm' => $form->createView()]
        );
    }

    public function deleteServiceAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneByUser($user);

        $vendorService = $em->getRepository(VendorService::class)->findOneBy(
            [
                'vendor' => $vendor,
                'id' => $id
            ]
        );

        if ($vendorService) {
            $em->remove($vendorService);
            $em->flush();
        }

        return $this->redirectToRoute('vendor_service');
    }

    public function tasksAction(Request $request)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $task = new Task;

        $form = $this->createForm(TaskType::class, $task, ['method' => 'PATCH']);

        if ($request->isMethod('PATCH')) {
            
            if ($request->request->get($form->getName())['id']) {
                $id = $request->request->get($form->getName())['id'];
                $task = $em->getRepository(Task::class)->find($id);
                $form = $this->createForm(TaskType::class, $task, ['method' => 'PATCH']);
            }

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if (!$task->getId()) {
                    $task->setCreatedAt(new \Datetime);
                }
                
                $task->setUser($user);
                $em->persist($task);
                $em->flush();

                return $this->redirectToRoute('vendor_todo');
            }
        }

        $taskList = $user->getTasks();
        $list = [];
        foreach ($taskList as $task) {
            $task->deleteForm = $this->createDeleteTaskForm($task)->createView();
            $list[$task->getDate()->format('Y-m-01')][] = $task;
        }

        return $this->render('UserBundle::Profile/Vendor/todo.html.twig',
            [
                'form' => $form->createView(),
                'list' => $list
            ]
        );
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
