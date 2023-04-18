<?php
declare(strict_types=1);
session_start();
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
$tickets = [];

try {
    $pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
    $stmt = $pdo->prepare("SELECT * FROM ticket ORDER BY created DESC");
    $stmt->execute();
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    die($e-> getMessage ());
}

require "views/tickets-list.view.php";