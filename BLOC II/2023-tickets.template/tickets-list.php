<?php
declare(strict_types=1);
session_start();
require_once 'src/DB.php';
$db = new DB('ticket','root','secret');
if(empty($_SESSION["user"])){
        header("Location: login.php");
        exit();
    }

if($_SESSION['user'] != 'admin') {
    header("Location: login.php");
    exit();
}
$tickets = [];

try {
    $stmt = $db->run("SELECT * FROM ticket ORDER BY created DESC");
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    die($e-> getMessage ());
}

require "views/tickets-list.view.php";