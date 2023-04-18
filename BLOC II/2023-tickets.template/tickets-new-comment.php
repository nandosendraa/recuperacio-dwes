<?php declare(strict_types=1);
session_start();


$comentari['fecha'] = "";
$comentari['msg'] = "";
$id = $_SESSION['lastTicketID'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $comentari['fecha'] = $_GET['date'];
    $comentari['msg'] = $_GET['message'];

    if ($comentari['msg'] == '')
        $errors[]='El missatge es obligatori';
    elseif ($comentari['msg'] < 200)
        $errors[]='El missatge es massa llarg';
}
if (empty($errors)) {
    $date = new DateTime();
    try {
        $pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
        $stmt = $pdo->prepare('INSERT INTO ticket_comment (ticket_id, msg, created) VALUES (:ticket_id, :msg, :created)');
        $stmt->execute([
            ':ticket_id' => $id,
            ':msg' => $comentari['msg'],
            ':created' => $date->format("Y-m-d H:i:s"),
        ]);
    } catch (PDOException $e) {
        var_dump($e);
    }
    unset($_SESSION['comentari']);
    header('Location: tickets-comment.php?id='.$id);
    exit();
}else{
    $_SESSION['comentari'] = $comentari;
    $_SESSION['errors'] = $errors;
    header('Location: tickets-comment.php?id='.$id);
    exit();
}

