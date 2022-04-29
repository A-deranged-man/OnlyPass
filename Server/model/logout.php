<?php
session_start();
// Destroy session
session_unset();
session_destroy();
// Redirecting To Home Page
session_start();
$_SESSION["access"] = true;
header("Location: ../view/account.php");
exit();

