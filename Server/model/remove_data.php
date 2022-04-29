<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api.php');
$api = new api();
switch($requestMethod) {
    case 'GET':

        if($_GET['entry_id']&&$_GET['user_id']) {
            $api->remove_data($_GET['entry_id'],$_GET['user_id']);
            header("Location: ../view/home.php");
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}