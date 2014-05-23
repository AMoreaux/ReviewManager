<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('tutor', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Tutor:index',
)));

$collection->add('tutor_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Tutor:show',
)));

$collection->add('tutor_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Tutor:new',
)));

$collection->add('tutor_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Tutor:create'),
    array('_method' => 'post')
));

$collection->add('tutor_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Tutor:edit',
)));

$collection->add('tutor_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Tutor:update'),
    array('_method' => 'post|put')
));

$collection->add('tutor_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Tutor:delete'),
    array('_method' => 'post|delete')
));

return $collection;
