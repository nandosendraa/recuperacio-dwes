<?php
declare(strict_types=1);
require_once 'src/DB.php';
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

if (isset($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $_SESSION['lastTicketID']=$id;

    $stmt = $db->run("SELECT * FROM ticket_comment WHERE ticket_id = :id",[':id'=>$id]);
    $comentaris = $stmt->fetchAll();

    $stmt = $db->run("SELECT * FROM ticket WHERE id = :id",[':id'=>$id]);
    $data = $stmt->fetch();
}

require "views/tickets-comment.view.php";