<?php
declare(strict_types=1);
session_start();

$username = $_SESSION["username"] ?? "";
$errors = $_SESSION["error"] ?? [];

unset($_SESSION["error"]);

require_once 'views/login.view.php';
