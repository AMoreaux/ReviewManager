<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('examen', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Examen:index',
)));

$collection->add('examen_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Examen:show',
)));

$collection->add('examen_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Examen:new',
)));

$collection->add('examen_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Examen:create'),
    array('_method' => 'post')
));

$collection->add('examen_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Examen:edit',
)));

$collection->add('examen_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Examen:update'),
    array('_method' => 'post|put')
));

$collection->add('examen_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Examen:delete'),
    array('_method' => 'post|delete')
));

return $collection;
