<?php

include("../model/api.php");
$api = new api();
if($_SESSION["access"] === true){
    if($_SESSION["logged-in"] === true) {
        include("header.php");
        $password_data = json_decode($api->get_data($_SESSION["user_id"]));

        echo"<div class=\"container-fluid\"><br>
<h5> Passwords:</h5><br><form action=\"../model/insert_data.php\" method=\"post\">
                <div class=\"form-group\">
                    <input type=\"text\" name=\"site_name\" class=\"form-control\" id=\"site_name\" placeholder=\"Enter a website name here\" width='50%'>
                </div>
                    <button type=\"submit\" class=\"btn btn-primary\" style='background-color: #00AFF0 !important'>
                        <i class=\"fa fa-plus-square-o\" aria-hidden=\"true\"></i> Add Site
                    </button>
                </form>
                <br>
                <div class=\"row\">";

        for ($j = 0; $j < count($password_data); $j++) {
            echo "


    <div class=\"card w-50\">
        <div class=\"card-body\">
            <h5 class=\"card-title\">{$password_data[$j]-> site_name}</h5>
            <p class=\"card-text\" id=\"password.$j.\"><b> {$password_data[$j]->  password_plain}</b></p>
            <a class=\"btn btn-secondary\" href=\"#\" role=\"button\" onclick=\"CopyToClipboard('password.$j.');return false;\">
            <i class=\"fa fa-clone\" aria-hidden=\"true\"></i>
            </a>
            <a class=\"btn btn-danger\" href='../model/remove_data.php?entry_id={$password_data[$j]->  entry_id}&&user_id={$password_data[$j]->  user_id}' role=\"button\">
            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
            </a>
        </div>
    </div>";
        }

        echo"
</div>
</div>
<script>
        function CopyToClipboard(id)
        {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        }
    </script>";
        include("footer.php");
    }

    else{
        header("Location: account.php"); exit;
    }
}
else{
    header("HTTP/1.0 405 Method Not Allowed");
}



