<?php declare(strict_types=1);
session_start();
unset($_SESSION['errors']);
$pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
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

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :user");
    $stmt->bindParam(":user",$username);
    $stmt->execute();
    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(empty($userInfo)){
        $errors[] = "L'usuari no es correcte";
    }

    if(!empty($userInfo))
        if (!password_verify($password,$userInfo[0]['password']))
            $errors[]= "la contrasenya no es correcta";

}
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: login.php");
}else{
    $_SESSION['user'] = $username;
    $_SESSION['uid'] = $userInfo[0]['id'];
    header("Location: index.php");
}