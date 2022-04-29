<?php
session_start();
if($_SESSION["access"] === true){
include("header.php");
?>
<div class="st-xlarge st-text-grey">
   About OnlyPass
</div><br>

    <div class="st-row">
    <h4>Introduction</h4>

        <p>OnlyPass is a free password manager developed by Dylan Baker using PHP, HTML, JavaScript, CSS, Bootstrap, C#, XAML, Java & XML. It is designed to be secure, fast and easy to use.
        </p>

        <p>We aim to deliver high quality applications at a low cost using the Agile development methodology known as SCRUM.
        </p>
        <br>

    <h4>Development</h4>

        <p>After originally being based moreso in C# using a REST API written in PHP the front-end was created using Boostrap & JavaScript primarily, with additional functionality provided by native application features found in C# and Java for Windows and Android.</p>
        <br>

    </div>

<?php
include("footer.php");
}
else{
    header("HTTP/1.0 405 Method Not Allowed");
}
?>