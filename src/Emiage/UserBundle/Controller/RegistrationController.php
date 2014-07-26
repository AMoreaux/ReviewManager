<?php

namespace Emiage\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();
            $userRole = $user->getRoles();
            if('ROLE_STUD' == $userRole[0]){
                $this->sendMail($user);
            }

            $route = 'user';
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            
            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
    }

    public function sendMail($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Inscription à la plateforme ReviewManager')
            ->setFrom('moreaux.antoine@gmail.com')
            ->setTo($mail = $user->getEmail())
            ->setBody($this->container->get('templating')->render('EmiageUserBundle:User:email.html.twig', array('user' => $user)))
        ;

        $this->container->get('mailer')->send($message);

        return $message;
    }
}