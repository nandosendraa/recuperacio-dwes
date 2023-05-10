<?php declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; ?>
<?php
require_once 'src/DB.php';
session_start();
$db = new DB('ticket','root','secret');
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['id'] = $_GET['id'];

    $stmt = $db->run("SELECT * FROM ticket WHERE id = :id",[':id' => $_SESSION['id']]);
    $data = $stmt->fetch();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $response = $_POST['response'];
    if ($response == 'No') {
        unset($_SESSION['id']);
        header('Location: tickets-list.php');
        exit();
    }
    if ($response == 'Si'){
        $db->run("DELETE  FROM ticket WHERE id = :id",[':id' => $_SESSION['id']]);

        $message = "S'ha eliminat el ticket correctament";
        unset($_SESSION['id']);
        header('Location: tickets-list.php');
        exit();
    }
}
$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/tickets-delete.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();
