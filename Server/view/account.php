<?php
session_start();
if($_SESSION["access"] === true){
    if($_SESSION["logged-in"] === true)
    {
        header("Location: home.php");
    }
    else{
        include ("header.php");
        echo "


    <form class=\"form\" action=\"../model/register_user.php\" method=\"post\">
        <h1>Make a new account</h1>

        <div class=\"fieldWrapper\">
            <label for=\"fname\">First Name:</label>
            <br>
            <input type=\"text\" name=\"fname\" id=\"fname\" placeholder=\"First Name\">
        </div>

        <div class=\"fieldWrapper\">
            <label for=\"lname\">Last Name:</label>
            <br>
            <input type=\"text\" name=\"lname\" id=\"lname\" placeholder=\"Last Name\">
        </div>


        <div class=\"fieldWrapper\">
            <label for=\"email\">Email Address:</label>
            <br>
            <input type=\"text\" name=\"email\" id=\"email\" placeholder=\"Email Address\" required onkeyup=\"validateEmail(); return false;\">
            <span id=\"confirmEmail\" class=\"confirmEmail\"></span>
        </div>

        <div class=\"fieldWrapper\">
            <label for=\"password_entry\">Password:</label>
            <br>
            <input type=\"password\" name=\"password\" id=\"password_entry\" value=\"\" placeholder=\"Password\" required>
        </div>
        <div class=\"fieldWrapper\">
            <label for=\"pass2\">Confirm Password:</label>
            <br>
            <input type=\"password\" name=\"confirm_pass\" id=\"pass2\" onkeyup=\"checkPass(); return false;\" value=\"\">
            <span id=\"confirmMessage\" class=\"confirmMessage\"></span>
        </div>
        <br>
        <input type=\"submit\" name=\"submit\" value=\"Register\">
    </form>

    <script src=\"../model/validate.js\"></script>
    <br>
<p>After registering a new account please log-in with the form below</p><br>

<form class=\"form\" action=\"../model/login_user.php\" method=\"post\" name=\"login\">
        <h1>Log-in</h1>
        <p>Email Address:
            <br>
            <input type=\"text\" name=\"email\" placeholder=\"Email Address\"/>
        </p>
        <p>Password:
            <br>
            <input type=\"password\" name=\"password\" placeholder=\"Password\"/>
        </p>
        <input type=\"submit\" value=\"Login\" name=\"submit\"/>
    </form>";

        include ("footer.php");
    }

}
else{
    header("HTTP/1.0 405 Method Not Allowed");
}
