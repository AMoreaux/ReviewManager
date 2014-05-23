<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('note', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Note:index',
)));

$collection->add('note_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Note:show',
)));

$collection->add('note_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Note:new',
)));

$collection->add('note_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Note:create'),
    array('_method' => 'post')
));

$collection->add('note_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Note:edit',
)));

$collection->add('note_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Note:update'),
    array('_method' => 'post|put')
));

$collection->add('note_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Note:delete'),
    array('_method' => 'post|delete')
));

return $collection;
