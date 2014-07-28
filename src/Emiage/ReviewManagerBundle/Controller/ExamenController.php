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
use Symfony\Component\HttpFoundation\Response;

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
     * @Secure(roles="ROLE_ADMIN")
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
            $examensArray = $em->getRepository('EmiageReviewManagerBundle:Examen')->findExamen($motclef);
        }

        else
        {
            $examensArray = $em->getRepository('EmiageReviewManagerBundle:Examen')->findAll();
        }

        $adapter  = new ArrayAdapter($examensArray);
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

            $code = 'E'.$entity->getId();
            $entity -> setcode($code);

            $em->flush();



            return $this->redirect($this->generateUrl('examen'));
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

        return $this->render('EmiageReviewManagerBundle:Examen:print.html.twig', array(
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

    public function inscriptionAction($id, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $examensArray = $em->getRepository('EmiageReviewManagerBundle:Examen')->findByModule($id);

        $adapter  = new ArrayAdapter($examensArray);
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

        return $this->render('EmiageReviewManagerBundle:Examen:index.html.twig', array(
            'entities' => $entities));
    }

    /**
     * @Secure(roles="ROLE_STUD")
     */
    public function addStudentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        $user = $this->getUser()->getUsername();
        $student = $em->getRepository('EmiageReviewManagerBundle:Student')->findOneByName($user);


        $entity->addStudent($student);

        $em->flush();

        $idm = $entity->getModule()->getId();
        $ide = $student->getId();

        return $this->redirect($this->generateUrl('note_new_by_student', array(
            'idm'=>$idm,
            'ide'=>$ide,)));
    }

    /*public function printPvAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        return $this->render('EmiageReviewManagerBundle:Examen:print.html.twig', array(
            'entity' => $entity));
    }


    public function printPvAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Examen')->find($id);

        $codeModule = $entity->getModule()->getCode();
        $nameCenter = $entity->getReviewCenter()->getName();
        $fileName = $codeModule.$nameCenter.'.pdf';
        $path = 'uploads/documents/PV/'.$fileName;

        if(file_exists($path)){}
        else
        {
            $this->get('knp_snappy.pdf')->generateFromHtml( $this->renderView('EmiageReviewManagerBundle:Examen:print.html.twig',array(
            'entity'  => $entity)),
            $path);
        }

        $download = $this->download($path, $fileName);

        return $download;

    }

    public function download($path, $fileName)
    {
        $response = new Response();
        $response->setContent(file_get_contents($path));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fileName);

        return $response;
    }*/
}

