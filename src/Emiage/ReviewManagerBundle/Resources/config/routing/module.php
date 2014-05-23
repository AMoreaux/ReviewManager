<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('module', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:Module:index',
)));

$collection->add('module_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:Module:show',
)));

$collection->add('module_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:Module:new',
)));

$collection->add('module_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:Module:create'),
    array('_method' => 'post')
));

$collection->add('module_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:Module:edit',
)));

$collection->add('module_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:Module:update'),
    array('_method' => 'post|put')
));

$collection->add('module_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:Module:delete'),
    array('_method' => 'post|delete')
));

return $collection;
