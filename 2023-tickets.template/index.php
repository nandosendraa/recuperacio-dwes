<?php declare(strict_types=1); ?>
<?php session_start();


if (false)
    die("Aquest pàgina sols admet el mètode GET");

$mode = 'clar';

if (isset($_GET['mode'])) {
    setcookie('mode', $_GET['mode'], time() + (60 * 60 * 24 * 7));
    $mode= $_GET['mode'];
}else if (isset($_COOKIE['mode']))
    $mode = $_COOKIE['mode'];

const MAX_SIZE = 1024*1000;

require "views/index.view.php";
