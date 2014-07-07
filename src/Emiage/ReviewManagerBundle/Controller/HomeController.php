<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

Class HomeController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            return $this->redirect($this->generateUrl('module'));
        }
        elseif($this->get('security.context')->isGranted('ROLE_PROF'))
        {
            return $this->redirect($this->generateUrl('note'));
        }
        elseif($this->get('security.context')->isGranted('ROLE_STUD'))
        {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $username = $user ->getUsername();
            $student = $em->getRepository('EmiageReviewManagerBundle:Student')->findOneByname($username);

            if(empty($student))
            {
                return  $this->redirect($this->generateUrl('student_new'));
            }
            elseif($student->getname() === $username )
            {
                return $this->redirect($this->generateUrl('student_show', array(
                    'id'=>$student->getId(),
                )));
            }
        }
        else
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

    /*public function StudentDirection()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser()->getUsername();

        $entities = $em->getRepository('EmiageReviewManagerBundle:Student')->find($user);

        if(isset($entities))
        {
            return $this->redirect($this->generateUrl('student_show', array(
                'id'=>$entities->getId(),
            )));
        }

        return  $this->redirect($this->generateUrl('student_new'));
    }*/
}