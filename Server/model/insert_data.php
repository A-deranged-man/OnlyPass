<?php
session_start();
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api.php');
$api = new api();
switch($requestMethod) {
    case 'POST':
        if($_POST['site_name']) {

            $api->insert_data($_POST['site_name'],$_SESSION['user_id']);

            header("Location: ../view/home.php");
        }

        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}