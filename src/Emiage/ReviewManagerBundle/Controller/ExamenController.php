<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Emiage\ReviewManagerBundle\Entity\Examen;
use Emiage\ReviewManagerBundle\Form\ExamenType;
use Emiage\ReviewManagerBundle\Form\ResearchFormType;


/**
 * Examen controller.
 *
 */
class ExamenController extends Controller
{

    /**
     * Lists all Examen entities.
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ResearchFormType());

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            $motclef = $form["motclef"]->getData();

            $entities = $em->getRepository('EmiageReviewManagerBundle:Examen')->findExamen($motclef);
        }

        else
        {
            $entities = $em->getRepository('EmiageReviewManagerBundle:Examen')->findAll();
        }

        return $this->render('EmiageReviewManagerBundle:Examen:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Examen entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        $entity = new Examen();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('examen_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:Examen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Examen entity.
    *
    * @param Examen $entity The entity
    * @Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Examen $entity)
    {
        $form = $this->createForm(new ExamenType(), $entity, array(
            'action' => $this->generateUrl('examen_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Examen entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Examen();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Examen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Examen entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Examen:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Examen entity.
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        if($this->get('security.context')->isGranted('ROLE_STUD'))
        {
            $this->addStudent($id);
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmiageReviewManagerBundle:Examen:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Examen entity.
    *
    * @param Examen $entity The entity
    * @Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Examen $entity)
    {
        $form = $this->createForm(new ExamenType(), $entity, array(
            'action' => $this->generateUrl('examen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Examen entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('examen'));
        }

        return $this->render('EmiageReviewManagerBundle:Examen:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Examen entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Examen entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('examen'));
    }

    public function inscriptionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EmiageReviewManagerBundle:Examen')->findByModule($id);

        return $this->render('EmiageReviewManagerBundle:Examen:index.html.twig', array(
            'entities' => $entities));
    }

    public function addStudent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        $user = $this->getUser()->getUsername();
        $student = $em->getRepository('EmiageReviewManagerBundle:Student')->findOneByName($user);


        $entity->addStudent($student);

        $em->flush();

        return $this->redirect($this->generateUrl('home'));
    }
}
