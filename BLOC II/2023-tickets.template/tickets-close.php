<?php declare(strict_types=1); ?>
<?php
require_once 'src/DB.php';
session_start();
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
$db = new DB('ticket','root','secret');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['id'] = $_GET['id'];

    $stmt = $db->run("UPDATE ticket SET status_id = 2 WHERE id = :id",[':id'=>$_SESSION['id']]);
    $data = $stmt->fetch();
    header('Location: tickets-list.php');
    exit();
}

