<?php
declare(strict_types=1);
session_start();
require_once 'src/FlashMessage.php';
$username = $_SESSION["username"] ?? "";
$errors = FlashMessage::get('errors',[]);


require_once 'views/login.view.php';
