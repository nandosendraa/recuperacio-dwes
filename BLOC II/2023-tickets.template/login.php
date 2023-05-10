<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


require_once 'src/FlashMessage.php';
$username = $_SESSION["username"] ?? "";
$errors = FlashMessage::get('errors',[]);

$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/login.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();

