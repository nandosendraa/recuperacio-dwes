<?php declare(strict_types=1);
session_start();

const MAX_SIZE = 1024 * 1000;
const SCREENSHOT_PATH = "uploads";

$data["title"] = "";
$data["message"] = "";
$data["email"] = "";

$validTypes = ["image/jpeg", "image/jpg"];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data["title"] = $_POST['title'];
    $data["message"] = $_POST['message'];
    $data["email"] = $_POST['email'];

    if ($data['title'] == '')
        $errors[]='El titol es obligatori';
    elseif ($data['title'] < 30)
        $errors[]='El titol es massa llarg';

    if ($data['message'] == '')
        $errors[]='El missatge es obligatori';
    elseif ($data['message'] < 200)
        $errors[]='El missatge es massa llarg';

    if ($data['email'] == '')
        $errors[]='El correu es obligatori';
    elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $errors[]='El correu no es valid';
}

/*if (!empty($_FILES['screenshot']) && ($_FILES['screenshot']['error'] == UPLOAD_ERR_OK)) {
    if (!file_exists(SCREENSHOT_PATH))
        mkdir(SCREENSHOT_PATH, 0777, true);

    $tempFilename = $_FILES["screenshot"]["tmp_name"];
    $currentFilename = $_FILES["screenshot"]["name"];


    $extension = explode("/", $_FILES["screenshot"]["type"])[1];
    $newFilename = md5((string)rand()) . "." . $extension;
    $newFullFilename = SCREENSHOT_PATH . "/" . $newFilename;
    $fileSize = $_FILES["screenshot"]["size"];

    move_uploaded_file($tempFilename, $newFullFilename);

    $data["screenshot"] = $newFilename;

}*/

if (empty($errors)) {
    $_SESSION['data'] = $data;
    $_SESSION['errors'][] = "S'ha creat la incidencia numero ##";
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=ticket", "root", "secret");
    }
    catch (PDOException $e){var_dump($e);}

    header('Location: index.php');
    exit();
}else{
    $_SESSION['data'] = $data;
    $_SESSION['errors'] = $errors;
    header('Location: index.php');
    exit();
}



