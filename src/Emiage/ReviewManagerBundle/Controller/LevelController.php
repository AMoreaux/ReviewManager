<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Emiage\ReviewManagerBundle\Entity\Level;
use Emiage\ReviewManagerBundle\Form\LevelType;

/**
 * Level controller.
 *
 */
class LevelController extends Controller
{

    /**
     * Lists all Level entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmiageReviewManagerBundle:Level')->findAll();

        return $this->render('EmiageReviewManagerBundle:Level:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Level entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Level();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('level_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:Level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Level entity.
    *
    * @param Level $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Level $entity)
    {
        $form = $this->createForm(new LevelType(), $entity, array(
            'action' => $this->generateUrl('level_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Level entity.
     *
     */
    public function newAction()
    {
        $entity = new Level();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Level entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Level entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:Level:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Level entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Level entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EmiageReviewManagerBundle:Level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Level entity.
    *
    * @param Level $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Level $entity)
    {
        $form = $this->createForm(new LevelType(), $entity, array(
            'action' => $this->generateUrl('level_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Level entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Level entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('level_edit', array('id' => $id)));
        }

        return $this->render('EmiageReviewManagerBundle:Level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Level entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Level')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Level entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('level'));
    }

    /**
     * Creates a form to delete a Level entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('level_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
