<?php

namespace Emiage\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends Controller
{

    /**
    * Edit the user
    */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('EmiageUserBundle:User')->find($id);



        $form = $this->container->get('fos_user.profile.form');
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process)
        {

            return $this->redirect($this->generateUrl('user'));
        }

        return $this->container->get('templating')->renderResponse(
        'EmiageUserBundle:User:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
        array('form' => $form->createView(),
        'id'=> $id)
        );
    }
}