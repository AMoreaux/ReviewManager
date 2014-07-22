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

use Emiage\ReviewManagerBundle\Entity\Student;
use Emiage\ReviewManagerBundle\Form\StudentType;
use Emiage\ReviewManagerBundle\Entity\Module;
use Emiage\ReviewManagerBundle\Entity\Note;
use Emiage\ReviewManagerBundle\Entity\Examen;
use Emiage\ReviewManagerBundle\Form\ResearchFormType;

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
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ResearchFormType());
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            $motclef = $form["motclef"]->getData();

            $studentsArray = $em->getRepository('EmiageReviewManagerBundle:Student')->findStudent($motclef);
        }
        else
        {
            $studentsArray = $em->getRepository('EmiageReviewManagerBundle:Student')->findAll();
        }

        $adapter  = new ArrayAdapter($studentsArray);
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


        return $this->container->get('templating')->renderResponse('EmiageReviewManagerBundle:Student:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView()));
}

    /**
     * Creates a new Student entity.
     * @Secure(roles="ROLE_STUD")
     */
    public function createAction(Request $request)
    {
        $entity = new Student();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->getUser();
            $username = $user->getUsername();
            $userId = $user->getId();
            $userMail = $user->getemail();

            $login = $username[0].$userId;

            $entity->setname($username);
            $entity->setlogin($login);
            $entity->setmail($userMail);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->sendmail();

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
    * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

        $studentName = $entity->getName();

        if((($this->get('security.context')->isGranted('ROLE_STUD')) and ($user = $this->getUser()->getUsername() != $studentName)))
        {
             return $this->redirect($this->generateUrl('home'));
        }

        $entity = $em->getRepository('EmiageReviewManagerBundle:Student')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Student entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Student:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Student entity.
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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
    * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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

            if($this->get('security.context')->isGranted('ROLE_STUD'))
            {
                return $this->redirect($this->generateUrl('home'));
            }
            else
            {
                return $this->redirect($this->generateUrl('student'));
            }
        }
        return $this->render('EmiageReviewManagerBundle:Student:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Student entity.
     * @Secure(roles="ROLE_ADMIN, ROLE_STUD")
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

    public function addModuleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EmiageReviewManagerBundle:Module')->find($id);

        $user = $this->getUser()->getUsername();
        $student = $em->getRepository('EmiageReviewManagerBundle:Student')->findOneByName($user);

        $student->addModule($entity);

        $em->flush();

        return $this->redirect($this->generateUrl('home'));

    }

    public function sendmail()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Inscription on Review Manager')
            ->setFrom('moreaux.antoine@gmail.com')
            ->setTo('nemesis98@hotmail.fr')
            ->setBody('test')
        ;
        $this->get('mailer')->send($message);

        return $message;
    }
}
