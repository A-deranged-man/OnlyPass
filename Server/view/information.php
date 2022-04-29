<?php
session_start();
if($_SESSION["access"] === true){
    include("header.php");
    echo"<img src=\"op1.png\"><img src=\"op2.png\">";
    include("footer.php");
}
else{
    header("HTTP/1.0 405 Method Not Allowed");
}