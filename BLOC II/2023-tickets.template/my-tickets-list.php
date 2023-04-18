<?php

declare(strict_types=1);
session_start();
if (empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$tickets = [];

try {
    $pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE user_id = :user_id ORDER BY created DESC");
    $stmt->execute([
        ':user_id' => $_SESSION['uid']
        ]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}

require "views/my-tickets-list.view.php";