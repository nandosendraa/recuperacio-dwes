<?php
session_start();

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
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register.php");
    }
    if (empty($errors)) {
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        try {
            $pdo = new PDO("mysql:host=mysql-server; dbname=ticket", "root", "secret");
            $stmt = $pdo->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
            $stmt->execute([
                ':username' => $user,
                ':password' => $hashedPassword
            ]);
        } catch (PDOException $e) {
            var_dump($e);
        }
        $_SESSION['user'] = $user;
        $_SESSION['uid'] = $pdo->lastInsertId();
        header("Location: index.php");
    }
}
require "views/register.view.php";