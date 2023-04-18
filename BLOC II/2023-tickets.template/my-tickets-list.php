<?php

declare(strict_types=1);
require_once 'src/DB.php';
session_start();
if (empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$tickets = [];

try {
    $db = new DB('ticket','root','secret');
    $stmt = $db->run("SELECT * FROM ticket WHERE user_id = :user_id ORDER BY created DESC",[':user_id'=>$_SESSION['uid']]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}

require "views/my-tickets-list.view.php";