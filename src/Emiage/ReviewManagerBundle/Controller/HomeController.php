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
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            return $this->redirect($this->generateUrl('module'));
        }
        elseif(!$this->get('security.context')->isGranted('ROLE_PROF'))
        {
            return $this->redirect($this->generateUrl('note'));
        }
        elseif(!$this->get('security.context')->isGranted('ROLE_ETU'))
        {
            return $this->redirect($this->generateUrl('student'));
        }
        else
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }
}