<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api.php');
$api = new api();
switch($requestMethod) {
    case 'POST':
        $pattern = '/[A-Za-z0-9]+/';

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            echo "<div class='form'>
              <h3>Email Address Invalid.</h3><br/>
              <p class='link'><a href='../view/account.php'>Click here to register again.</a></p>
              </div>";
        }
        else if (preg_match($pattern, $_POST['fname']) == 0 || preg_match($pattern, $_POST['lname']) == 0)
        {
            echo "<div class='form'>
              <h3>Name Invalid.</h3><br/>
              <p class='link'><a href='../view/account.php'>Click here to register again.</a></p>
              </div>";
        }
        else if (strlen($_POST['password']) > 60 || strlen($_POST['password']) < 5)
        {
            echo "<div class='form'>
              <h3>Password Over character limit (60 characters max)</h3><br/>
              <p class='link'><a href='../view/account.php'>Click here to register again.</a></p>
              </div>";
        }
        else
        {
            $api->register_user($_POST['email'],$_POST['fname'],$_POST['lname'],$_POST['password']);
            header("Location: ../view/account.php");

        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;


}