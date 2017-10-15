<?php

namespace CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CmsBundle\Entity\TwigTemplate;
use CmsBundle\Form\TwigTemplateType;

/**
 * TwigTemplate controller.
 *
 * @Route("/twigtemplate")
 */
class TwigTemplateController extends Controller
{

    /**
     * Lists all TwigTemplate entities.
     *
     * @Route("/", name="twigtemplate")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmsBundle:TwigTemplate')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TwigTemplate entity.
     *
     * @Route("/", name="twigtemplate_create")
     * @Method("POST")
     * @Template("CmsBundle:TwigTemplate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TwigTemplate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('twigtemplate_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TwigTemplate entity.
     *
     * @param TwigTemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TwigTemplate $entity)
    {
        $form = $this->createForm(new TwigTemplateType(), $entity, array(
            'action' => $this->generateUrl('twigtemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TwigTemplate entity.
     *
     * @Route("/new", name="twigtemplate_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TwigTemplate();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TwigTemplate entity.
     *
     * @Route("/{id}", name="twigtemplate_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:TwigTemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TwigTemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TwigTemplate entity.
     *
     * @Route("/{id}/edit", name="twigtemplate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:TwigTemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TwigTemplate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TwigTemplate entity.
    *
    * @param TwigTemplate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TwigTemplate $entity)
    {
        $form = $this->createForm(new TwigTemplateType(), $entity, array(
            'action' => $this->generateUrl('twigtemplate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TwigTemplate entity.
     *
     * @Route("/{id}", name="twigtemplate_update")
     * @Method("PUT")
     * @Template("CmsBundle:TwigTemplate:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:TwigTemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TwigTemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('twigtemplate_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TwigTemplate entity.
     *
     * @Route("/{id}", name="twigtemplate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CmsBundle:TwigTemplate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TwigTemplate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('twigtemplate'));
    }

    /**
     * Creates a form to delete a TwigTemplate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('twigtemplate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
