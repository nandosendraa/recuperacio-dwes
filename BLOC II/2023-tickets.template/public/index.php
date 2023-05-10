<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$response = new Response();

$map = [
    '/' => __DIR__.'/../index.php',
    '/login' => __DIR__.'/../login.php',
    '/register' => __DIR__.'/../register.php',
    '/logout' => __DIR__.'/../logout.php',
    '/tickets-list' => __DIR__.'/../tickets-list.php',
    '/my-tickets-list' => __DIR__.'/../my-tickets-list.php',
];

$path = $request->getPathInfo();
if (isset($map[$path])) {
    require $map[$path];
} else {
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    $response->setContent('Not Found');
}

$response->send();