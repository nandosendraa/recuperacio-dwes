<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


require_once 'src/DB.php';
$db = new DB('ticket','root','secret');
if(empty($_SESSION["user"])){
        header("Location: login.php");
        exit();
    }

if($_SESSION['user'] != 'admin') {
    header("Location: login.php");
    exit();
}
$tickets = [];

try {
    $stmt = $db->run("SELECT * FROM ticket ORDER BY created DESC");
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    die($e-> getMessage ());
}
$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/tickets-list.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();

