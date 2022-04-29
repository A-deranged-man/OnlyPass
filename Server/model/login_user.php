<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api.php');
$api = new api();
switch($requestMethod) {
    case 'POST':
        if($_POST['email']&&$_POST['password']) {
            $api->login_user($_POST['email'],$_POST['password']);
            header("Location: ../view/home.php");
        }
        else{
            header("Location: ../view/account.php");
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}