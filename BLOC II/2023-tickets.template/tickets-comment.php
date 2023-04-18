<?php
declare(strict_types=1);
session_start();
$pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
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
    $stmt = $pdo->prepare("SELECT * FROM ticket_comment WHERE ticket_id = :id");
    $stmt->execute([
        ':id' => $id,
    ]);
    $comentaris = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE id = :id");
    $stmt->execute([
        ':id' => $id,

    ]);
    $data = $stmt->fetch();
}

require "views/tickets-comment.view.php";