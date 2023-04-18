<?php declare(strict_types=1); ?>
<?php session_start();
require_once 'src/FlashMessage.php';
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

if (false)
    die("Aquest pàgina sols admet el mètode GET");

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

require "views/index.view.php";
