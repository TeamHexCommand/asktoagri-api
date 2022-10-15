<?php
require_once __DIR__ . '/../vendor/autoload.php';

function generateGuid(): string
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
        return $uuid;
    }
}

function saveBizLogo($base)
{
    $name = self::generateGuid();
    // receive image as POST Parameter
    $image = str_replace('data:image/jpeg;base64,', '', $base);
    $image = str_replace(' ', '+', $image);
    // Decode the Base64 encoded Image
    $data = base64_decode($image);
    // Create Image path with Image name and Extension
    $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $name . '.jpg';
    // Save Image in the Image Directory
    $success = file_put_contents($file, $data);
    return $name;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $file_name = $_FILES['myFile']['name'];
    $file_size = $_FILES['myFile']['size'];
    $file_type = $_FILES['myFile']['type'];
    $temp_name = $_FILES['myFile']['tmp_name'];

    $location = "uploads/";

    move_uploaded_file($temp_name, $location . $file_name);
} else {
    echo "Error";
}

?>