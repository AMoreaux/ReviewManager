<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

Class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmiageReviewManagerBundle:Home:index.html.twig');
    }
}