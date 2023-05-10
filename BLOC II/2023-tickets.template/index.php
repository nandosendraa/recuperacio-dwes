<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; ?>
<?php session_start();
require_once __DIR__ . '/vendor/autoload.php';

require_once 'src/FlashMessage.php';
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}


$mode = 'clar';
$data["title"] = "";
$data["message"] = "";
$data["email"] = "";
$errors = [];

if (isset($_GET['mode'])) {
    setcookie('mode', $_GET['mode'], time() + (60 * 60 * 24 * 7));
    $mode= $_GET['mode'];
}else if (isset($_COOKIE['mode']))
    $mode = $_COOKIE['mode'];

if (isset($_SESSION['data']))
    $data = $_SESSION['data'];

$errors = FlashMessage::get('errors',[]);


const MAX_SIZE = 1024*1000;

$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/index.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();