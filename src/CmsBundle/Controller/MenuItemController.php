<?php

namespace CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CmsBundle\Entity\MenuItem;
use CmsBundle\Form\MenuItemType;

/**
 * MenuItem controller.
 *
 * @Route("/menuitem")
 */
class MenuItemController extends Controller
{

    /**
     * Lists all MenuItem entities.
     *
     * @Route("/", name="menuitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmsBundle:MenuItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MenuItem entity.
     *
     * @Route("/", name="menuitem_create")
     * @Method("POST")
     * @Template("CmsBundle:MenuItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MenuItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('menuitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a MenuItem entity.
     *
     * @param MenuItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MenuItem $entity)
    {
        $form = $this->createForm(new MenuItemType(), $entity, array(
            'action' => $this->generateUrl('menuitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MenuItem entity.
     *
     * @Route("/new", name="menuitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MenuItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MenuItem entity.
     *
     * @Route("/{id}", name="menuitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:MenuItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MenuItem entity.
     *
     * @Route("/{id}/edit", name="menuitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:MenuItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuItem entity.');
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
    * Creates a form to edit a MenuItem entity.
    *
    * @param MenuItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MenuItem $entity)
    {
        $form = $this->createForm(new MenuItemType(), $entity, array(
            'action' => $this->generateUrl('menuitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MenuItem entity.
     *
     * @Route("/{id}", name="menuitem_update")
     * @Method("PUT")
     * @Template("CmsBundle:MenuItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmsBundle:MenuItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MenuItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('menuitem_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MenuItem entity.
     *
     * @Route("/{id}", name="menuitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CmsBundle:MenuItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MenuItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('menuitem'));
    }

    /**
     * Creates a form to delete a MenuItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('menuitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
