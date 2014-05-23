<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emiage\ReviewManagerBundle\Entity\ReviewCenter;
use Emiage\ReviewManagerBundle\Form\ReviewCenterType;

/**
 * ReviewCenter controller.
 *
 */
class ReviewCenterController extends Controller
{

    /**
     * Lists all ReviewCenter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmiageReviewManagerBundle:ReviewCenter')->findAll();

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ReviewCenter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ReviewCenter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reviewcenter_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ReviewCenter entity.
    *
    * @param ReviewCenter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ReviewCenter $entity)
    {
        $form = $this->createForm(new ReviewCenterType(), $entity, array(
            'action' => $this->generateUrl('reviewcenter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ReviewCenter entity.
     *
     */
    public function newAction()
    {
        $entity = new ReviewCenter();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ReviewCenter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:ReviewCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReviewCenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ReviewCenter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:ReviewCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReviewCenter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ReviewCenter entity.
    *
    * @param ReviewCenter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ReviewCenter $entity)
    {
        $form = $this->createForm(new ReviewCenterType(), $entity, array(
            'action' => $this->generateUrl('reviewcenter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ReviewCenter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:ReviewCenter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReviewCenter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reviewcenter_edit', array('id' => $id)));
        }

        return $this->render('EmiageReviewManagerBundle:ReviewCenter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ReviewCenter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:ReviewCenter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ReviewCenter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reviewcenter'));
    }

    /**
     * Creates a form to delete a ReviewCenter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reviewcenter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
