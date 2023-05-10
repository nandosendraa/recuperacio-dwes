<?php declare(strict_types=1);
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once 'src/DB.php';
require_once 'src/FlashMessage.php';
$db = new DB('ticket','root','secret');
$username="";
$password="";
$errors=[];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username))
        $errors[]= "Has de introduir l'usuari";
    if(empty($password))
        $errors[]= "Has de introduir la contrasenya";

    $stmt = $db->run("SELECT * FROM user WHERE username = :user",[':user'=>$username]);
    $userInfo = $stmt->fetchAll();

    if(empty($userInfo)){
        $errors[] = "L'usuari no es correcte";
    }

    if(!empty($userInfo))
        if (!password_verify($password,$userInfo[0]['password']))
            $errors[]= "la contrasenya no es correcta";

}
if (!empty($errors)) {
    FlashMessage::set('errors',$errors);
    var_dump($errors);
    header("Location: login.php");
}else{
    $_SESSION['user'] = $username;
    $_SESSION['uid'] = $userInfo[0]['id'];
    header("Location: index.php");
}