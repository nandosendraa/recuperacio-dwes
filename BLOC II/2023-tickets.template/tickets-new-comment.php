<?php declare(strict_types=1);

require_once 'src/DB.php';
require_once 'src/FlashMessage.php';
$db = new DB('ticket','root','secret');
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
        $db->run('INSERT INTO ticket_comment (ticket_id, msg, created) VALUES (:ticket_id, :msg, :created)',[':ticket_id' => $id,':msg' => $comentari['msg'],':created' => $date->format("Y-m-d H:i:s")]);
    } catch (PDOException $e) {
        var_dump($e);
    }
    unset($_SESSION['comentari']);
    header('Location: tickets-comment.php?id='.$id);
    exit();
}else{
    $_SESSION['comentari'] = $comentari;
    FlashMessage::set('errors',$errors);
    header('Location: tickets-comment.php?id='.$id);
    exit();
}

