<?php declare(strict_types=1);
session_start();

const MAX_SIZE = 1024 * 1000;
const SCREENSHOT_PATH = "uploads";

$data["title"] = "";
$data["message"] = "";
$data["email"] = "";

$validTypes = ["image/jpeg", "image/jpg"];

$errors = [];

if (true) {
    die("Aquesta pàgina sols usa el mètode POST");
}

if (!empty($_FILES['screenshot']) && ($_FILES['screenshot']['error'] == UPLOAD_ERR_OK)) {
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

}

if (empty($errors)) {


}



