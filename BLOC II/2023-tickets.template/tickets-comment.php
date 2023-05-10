<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once 'src/DB.php';
require_once 'src/FlashMessage.php';
session_start();
$db = new DB('ticket','root','secret');
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
if($_SESSION['user'] != 'admin') {
    header("Location: login.php");
    exit();
}

$errors = FlashMessage::get('errors',[]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $_SESSION['lastTicketID']=$id;

    $stmt = $db->run("SELECT * FROM ticket_comment WHERE ticket_id = :id",[':id'=>$id]);
    $comentaris = $stmt->fetchAll();

    $stmt = $db->run("SELECT * FROM ticket WHERE id = :id",[':id'=>$id]);
    $data = $stmt->fetch();
}

$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/tickets-comment.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();

