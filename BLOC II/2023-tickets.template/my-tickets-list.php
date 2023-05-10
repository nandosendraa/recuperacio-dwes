<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/vendor/autoload.php';
require_once 'src/DB.php';
session_start();
if (empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$tickets = [];

try {
    $db = new DB('ticket','root','secret');
    $stmt = $db->run("SELECT * FROM ticket WHERE user_id = :user_id ORDER BY created DESC",[':user_id'=>$_SESSION['uid']]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}

$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/my-tickets-list.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();

