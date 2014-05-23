<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('reviewcenter', new Route('/', array(
    '_controller' => 'EmiageReviewManagerBundle:ReviewCenter:index',
)));

$collection->add('reviewcenter_show', new Route('/{id}/show', array(
    '_controller' => 'EmiageReviewManagerBundle:ReviewCenter:show',
)));

$collection->add('reviewcenter_new', new Route('/new', array(
    '_controller' => 'EmiageReviewManagerBundle:ReviewCenter:new',
)));

$collection->add('reviewcenter_create', new Route(
    '/create',
    array('_controller' => 'EmiageReviewManagerBundle:ReviewCenter:create'),
    array('_method' => 'post')
));

$collection->add('reviewcenter_edit', new Route('/{id}/edit', array(
    '_controller' => 'EmiageReviewManagerBundle:ReviewCenter:edit',
)));

$collection->add('reviewcenter_update', new Route(
    '/{id}/update',
    array('_controller' => 'EmiageReviewManagerBundle:ReviewCenter:update'),
    array('_method' => 'post|put')
));

$collection->add('reviewcenter_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EmiageReviewManagerBundle:ReviewCenter:delete'),
    array('_method' => 'post|delete')
));

return $collection;
