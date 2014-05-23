<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('registercenter', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:RegisterCenter:index',
)));

$collection->add('registercenter_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:RegisterCenter:show',
)));

$collection->add('registercenter_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:RegisterCenter:new',
)));

$collection->add('registercenter_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:RegisterCenter:create'),
    array('_method' => 'post')
));

$collection->add('registercenter_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:RegisterCenter:edit',
)));

$collection->add('registercenter_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:RegisterCenter:update'),
    array('_method' => 'post|put')
));

$collection->add('registercenter_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:RegisterCenter:delete'),
    array('_method' => 'post|delete')
));

return $collection;
