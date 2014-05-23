<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('student', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Student:index',
)));

$collection->add('student_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Student:show',
)));

$collection->add('student_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Student:new',
)));

$collection->add('student_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Student:create'),
    array('_method' => 'post')
));

$collection->add('student_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Student:edit',
)));

$collection->add('student_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Student:update'),
    array('_method' => 'post|put')
));

$collection->add('student_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Student:delete'),
    array('_method' => 'post|delete')
));

return $collection;
