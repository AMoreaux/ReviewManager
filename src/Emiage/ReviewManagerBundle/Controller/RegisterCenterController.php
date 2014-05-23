<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emiage\ReviewManagerBundle\Entity\RegisterCenter;
use Emiage\ReviewManagerBundle\Form\RegisterCenterType;

/**
 * RegisterCenter controller.
 *
 */
class RegisterCenterController extends Controller
{

    /**
     * Lists all RegisterCenter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmiageReviewManagerBundle:RegisterCenter')->findAll();

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new RegisterCenter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RegisterCenter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('registercenter_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a RegisterCenter entity.
    *
    * @param RegisterCenter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(RegisterCenter $entity)
    {
        $form = $this->createForm(new RegisterCenterType(), $entity, array(
            'action' => $this->generateUrl('registercenter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RegisterCenter entity.
     *
     */
    public function newAction()
    {
        $entity = new RegisterCenter();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RegisterCenter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:RegisterCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisterCenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing RegisterCenter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:RegisterCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisterCenter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a RegisterCenter entity.
    *
    * @param RegisterCenter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RegisterCenter $entity)
    {
        $form = $this->createForm(new RegisterCenterType(), $entity, array(
            'action' => $this->generateUrl('registercenter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RegisterCenter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:RegisterCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisterCenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registercenter_edit', array('id' => $id)));
        }

        return $this->render('EmiageReviewManagerBundle:RegisterCenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a RegisterCenter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:RegisterCenter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RegisterCenter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('registercenter'));
    }

    /**
     * Creates a form to delete a RegisterCenter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registercenter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
