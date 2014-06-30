<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Emiage\ReviewManagerBundle\Entity\Tutor;
use Emiage\ReviewManagerBundle\Form\TutorType;
use Emiage\ReviewManagerBundle\Form\ResearchFormType;

/**
 * Tutor controller.
 *
 */
class TutorController extends Controller
{

    /**
     * Lists all Tutor entities.
     *
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ResearchFormType());
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            $motclef = $form["motclef"]->getData();

            $tutorsArray = $em->getRepository('EmiageReviewManagerBundle:Tutor')->findTutor($motclef);
        }
        else
        {
            $tutorsArray = $em->getRepository('EmiageReviewManagerBundle:Tutor')->findAll();
        }

        $adapter  = new ArrayAdapter($tutorsArray);
        $entities = new PagerFanta($adapter);
        $entities->setMaxPerPage($this->container->getParameter('nbr_item_by_page'));

        try
        {
            $entities->setCurrentPage($page);
        }

        catch (NotValidCurrentPageException $e)
        {
            throw new NotFoundHttpException();
        }


        return $this->render('EmiageReviewManagerBundle:Tutor:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        $entity = new Tutor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tutor_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:Tutor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Tutor entity.
    * @Secure(roles="ROLE_ADMIN")
    * @param Tutor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Tutor $entity)
    {
        $form = $this->createForm(new TutorType(), $entity, array(
            'action' => $this->generateUrl('tutor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Tutor();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Tutor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Tutor:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmiageReviewManagerBundle:Tutor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tutor entity.
    *
    * @param Tutor $entity The entity
    * @Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tutor $entity)
    {
        $form = $this->createForm(new TutorType(), $entity, array(
            'action' => $this->generateUrl('tutor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tutor_edit', array('id' => $id)));
        }

        return $this->render('EmiageReviewManagerBundle:Tutor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a Tutor entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Tutor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tutor entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('tutor'));
    }

}
