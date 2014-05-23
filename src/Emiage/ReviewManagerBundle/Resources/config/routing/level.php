<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('level', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Level:index',
)));

$collection->add('level_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Level:show',
)));

$collection->add('level_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Level:new',
)));

$collection->add('level_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Level:create'),
    array('_method' => 'post')
));

$collection->add('level_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Level:edit',
)));

$collection->add('level_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Level:update'),
    array('_method' => 'post|put')
));

$collection->add('level_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Level:delete'),
    array('_method' => 'post|delete')
));

return $collection;
