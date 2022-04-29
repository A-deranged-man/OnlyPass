<?php
session_start();
$requestMethod = $_SERVER["REQUEST_METHOD"];
switch($requestMethod) {
    case 'GET':
        if($_GET['access_token']==="") {
            $_SESSION["access"] = true;
            header("Location: /cmp400/view/account.php");
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
