<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


session_start();
session_destroy();
session_unset();
header("Location: index.php");
exit();



$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/logout.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();
