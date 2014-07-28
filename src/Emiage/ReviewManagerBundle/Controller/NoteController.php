<?php

namespace Emiage\ReviewManagerBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Emiage\ReviewManagerBundle\Form\ResearchStudentByModuleType;
use Emiage\ReviewManagerBundle\Form\ResearchModuleType;
use Emiage\ReviewManagerBundle\Entity\Note;
use Emiage\ReviewManagerBundle\Form\NoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Form\Form;

/**
 * Note controller.
 *
 */
class NoteController extends Controller
{
    /**
     * Lists all Note entities.
     * @Secure(roles="ROLE_ADMIN, ROLE_PROF, ROLE_STUD")
     */
    public function indexAction($page)
    {
        $formModule = $this->createForm(new ResearchModuleType());
        $formStudent='';
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
/*
        if($this->get('security.context')->isGranted('ROLE_STUD')){
            $user = $this->getUser()->getUsername();
            $query{"student"} = $em->getRepository('EmiageReviewManagerBundle:Student')->findByName($user);
        }
*/

        $formModule->handleRequest($request);

        $data = $formModule->getData();

        if ($formModule->isValid() && null !== $data['module']) {
            $notesArray = $em->getRepository('EmiageReviewManagerBundle:Note')->findBy(array('module' => $data['module']));
            $formStudent = $this->createForm(new ResearchStudentByModuleType($id= $data['module']->getId()))->createView();
        } else {
            $notesArray = $em->getRepository('EmiageReviewManagerBundle:Note')->findAll();
        }

        $adapter  = new ArrayAdapter($notesArray);
        $entities = new PagerFanta($adapter);
        $entities->setMaxPerPage($this->container->getParameter('nbr_item_by_page'));

        try  {
            $entities->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e)  {
            throw new NotFoundHttpException();
        }

        return $this->container->get('templating')->renderResponse('EmiageReviewManagerBundle:Note:index.html.twig', array(
            'entities' => $entities,
            'formModule' => $formModule->createView(),
            'formStudent' => $formStudent,
            ));
    }

    /**
     * Creates a new Note entity.
     *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function createAction(Request $request)
    {
        $entity = new Note();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

           if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('note_show', array('id' => $entity->getId())));
            }

        return $this->render('EmiageReviewManagerBundle:Note:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Note entity.
    *
    * @param Note $entity The entity
    *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Note $entity)
    {
        $form = $this->createForm(new NoteType(), $entity, array(
            'action' => $this->generateUrl('note_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Note entity.
     *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function newAction()
    {
        $entity = new Note();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Note:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Note entity.
     *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Note entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Note:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Note entity.
     *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Note entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmiageReviewManagerBundle:Note:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Note entity.
    *
    * @param Note $entity The entity
    *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Note $entity)
    {

        $form = $this->createForm(new NoteType(), $entity, array(
            'action' => $this->generateUrl('note_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Note entity.
     *@Secure(roles="ROLE_ADMIN, ROLE_PROF")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Note entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('note'));
        }

        return $this->render('EmiageReviewManagerBundle:Note:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Note entity.
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Note')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Note entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('note'));
    }

    /**
    *@Secure(roles="ROLE_PROF")
    */
    public function downloadAction($slug)
    {
        $file = $slug;
        $path = "../../ReviewManager/web/uploads/documents/Copies/";

        $response = new Response();
        $response->setContent(file_get_contents($path.$file));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $file);

        return $response;
    }


    function addNoteAction($idm, $ide)
    {
        $em = $this->getDoctrine()->getManager();

        $entity= new Note();

        $student = $em->getRepository('EmiageReviewManagerBundle:Student')->find($ide);
        $module = $em->getRepository('EmiageReviewManagerBundle:Module')->find($idm);

        $entity->setStudent($student);
        $entity->setModule($module);

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('home'));
    }

    public function indexStudentAction($page, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        $student = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id)->getName();

        if($user === $student){

        $notesArray = $em->getRepository('EmiageReviewManagerBundle:Note')->findBystudent($id);

        $adapter  = new ArrayAdapter($notesArray);
        $entities = new PagerFanta($adapter);
        $entities->setMaxPerPage($this->container->getParameter('nbr_item_by_page'));

        try  {
            $entities->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e)  {
            throw new NotFoundHttpException();
        }

        return $this->container->get('templating')->renderResponse('EmiageReviewManagerBundle:Note:index.html.twig', array(
            'entities' => $entities,
        ));
        }

        return $this->redirect($this->generateUrl('home'));
    }
}

