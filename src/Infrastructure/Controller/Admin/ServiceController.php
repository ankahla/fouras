<?php

namespace Infrastructure\Controller\Admin;

use Infrastructure\Form\ServiceType;
use Model\Service;
use Services\FileManager;
use Services\FileUploader;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    #[Route(path: '/admin/services', name: 'admin_service_list')]
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Service::class);
        $services = $repository->findAll();

        return $this->render('admin/service/list.html.twig', ['services' => $services]);
    }

    
    #[Route(path: '/admin/service/new', name: 'admin_service_new')]
    public function new(Request $request)
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('admin_service_list', ['id' => $service->getId()]);
        }

        return $this->render('admin/service/new.html.twig',
            [
                'service' => $service,
                'new_form' => $form,
            ]
        );
    }

    
    #[Route(path: '/admin/service/{id}/show', name: 'admin_service_show')]
    public function show($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Service::class);
        $service = $repository->find($id);
        $deleteForm = $this->createDeleteForm($service);

        return $this->render('admin/service/show.html.twig', ['service' => $service, 'delete_form' => $deleteForm]);
    }

    
    #[Route(path: '/admin/service/{id}/edit', name: 'admin_service_edit')]
    public function edit(Request $request, FileManager $fileManager, $id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Service::class);
        /* @var Service $service */
        $service = $repository->find($id);
        $currentImage = $service->getImage();

        $service->setImage(
            new File($service->getImage() ? $this->getParameter('service_pic_dir').$service->getImage() : '', false)
        );

        $deleteForm = $this->createDeleteForm($service);
        $editForm = $this->createForm(ServiceType::class, $service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var ?UploadedFile $image */
            $image = $editForm->get('image')->getData();

            if ($image instanceof UploadedFile) {
                $fileManager->setTargetDirectory($this->getParameter('upload_service_pic_dir'));

                if ($filename = $fileManager->upload($image)) {
                    $fileManager->delete($currentImage);
                    $service->setImage($filename);
                }
            } else {
                $service->setImage($currentImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_service_list', ['id' => $service->getId()]);
        }

        return $this->render('admin/service/edit.html.twig', ['service' => $service, 'edit_form' => $editForm, 'delete_form' => $deleteForm]);
    }

    
    #[Route(path: '/admin/service/{id}/delete', name: 'admin_service_delete')]
    public function delete(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Service::class);
        $service = $repository->find($id);

        if ($service instanceof Service) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
        }

        return $this->redirectToRoute('admin_service_list');
    }

    /**
     * Creates a form to delete a service entity.
     *
     * @param Service $service The service entity
     *
     * @return FormInterface
     */
    private function createDeleteForm(Service $service): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_service_delete',['id' => $service->getId()]))
            ->setMethod('POST')
            ->add('delete', SubmitType::class)
            ->getForm()
            ;
    }
}
