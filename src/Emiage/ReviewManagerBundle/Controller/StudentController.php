<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Emiage\ReviewManagerBundle\Entity\Student;
use Emiage\ReviewManagerBundle\Form\StudentType;
use Emiage\ReviewManagerBundle\Entity\Module;
use Emiage\ReviewManagerBundle\Entity\Note;
use Emiage\ReviewManagerBundle\Entity\Examen;

/**
 * Student controller.
 *
 */
class StudentController extends Controller
{

    /**
     * Lists all Student entities.
     * @Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmiageReviewManagerBundle:Student')->findAll();

        return $this->render('EmiageReviewManagerBundle:Student:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        $entity = new Student();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->createNoteAction($entity);
            $this->createExamenAction($entity);

            return $this->redirect($this->generateUrl('student_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:Student:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Student entity.
    *
    * @param Student $entity The entity
    * @Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Student $entity)
    {
        $form = $this->createForm(new StudentType(), $entity, array(
            'action' => $this->generateUrl('student_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Student();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Student:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Student:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmiageReviewManagerBundle:Student:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Student entity.
    *
    * @param Student $entity The entity
    * @Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Student $entity)
    {
        $form = $this->createForm(new StudentType(), $entity, array(
            'action' => $this->generateUrl('student_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('student_edit', array('id' => $id)));
        }

        return $this->render('EmiageReviewManagerBundle:Student:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Student entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Student entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('student'));
    }

    public function createNoteAction($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $entity->getId();
        $modules = $em->getRepository('EmiageReviewManagerBundle:Module')->findWithStudents($id);

        foreach($modules as $module)
        {
            $note = new Note();

            $note->setstudent($entity);
            $note->setmodule($module);

            $em->persist($note);
        }
        $em->flush();
    }

    public function createExamenAction($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $entity->getId();
        $modules = $em->getRepository('EmiageReviewManagerBundle:Module')->findWithStudents($id);

        foreach($modules as $module)
        {
            $examen = new Examen();

            $examen->addstudent($entity);
            $examen->setmodule($module);

            $em->persist($examen);
        }
        $em->flush();
    }

}
