<?php declare(strict_types=1); ?>

<?php
session_start();
$pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['id'] = $_GET['id'];


    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE id = :id");
    $stmt->execute([
        ':id' => $_SESSION['id'],

    ]);
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
        $stmt = $pdo->prepare("DELETE  FROM ticket WHERE id = :id");
        $stmt->execute([
            ':id' => $_SESSION['id'],
        ]);
        $message = "S'ha eliminat el ticket correctament";
        unset($_SESSION['id']);
        header('Location: tickets-list.php');
        exit();
    }
}

require "views/tickets-delete.view.php";