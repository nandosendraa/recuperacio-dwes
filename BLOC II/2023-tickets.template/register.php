<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



require_once 'src/DB.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $password = $_POST['password'];
    if(empty($user))
        $errors[]= "Has de introduir l'usuari";
    elseif(strlen($user)>20)
        $errors[]= "L'usuari ha de tindre menys de 20 caracters";
    if(empty($password))
        $errors[]= "Has de introduir la contrasenya";
    elseif(strlen($user)>16)
        $errors[]= "La contrasenya ha de tindre menys de 16 caracters";
    if (empty($errors)) {
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        try {
            $db = new DB('ticket','root','secret');
            $db->run('INSERT INTO user (username, password) VALUES (:username, :password)',[':username'=>$user, ':password'=>$hashedPassword]);
        } catch (PDOException $e) {
            var_dump($e);
        }
        $_SESSION['user'] = $user;
        $_SESSION['uid'] = $db->getPDO()->lastInsertId();
        header("Location: index.php");
    }
}
$request = Request::createFromGlobals();

$response = new Response();

ob_start();
require __DIR__ . '/views/register.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set('content-type','text/html');
$response->send();