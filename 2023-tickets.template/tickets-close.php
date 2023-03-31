<?php declare(strict_types=1); ?>

<?php
session_start();
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
$pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['id'] = $_GET['id'];


    $stmt = $pdo->prepare("UPDATE ticket SET status_id = 2 WHERE id = :id");
    $stmt->execute([
        ':id' => $_SESSION['id'],

    ]);
    $data = $stmt->fetch();
    header('Location: tickets-list.php');
    exit();
}

