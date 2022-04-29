<!-- Footer -->
<br><br>
<footer class="st-padding-64 st-light-grey st-small st-center" id="footer">
    <div class="st-row-padding">
        <div class="st-col s4">
            <h4>Information</h4>
            <p><a class="st-text-black" href="information.php">How to use OnlyPass</a> </p>
        </div>

        <div class="st-col s4">
            <h4>About</h4>
            <p><a class="st-text-black" href="about.php">About OnlyPass</a></p>
            <p><a class="st-text-black" href="privacy_policy.php">Privacy Policy</a></p>
        </div>

        <div class="st-col s4 st-justify">
            <h4>Contact Me</h4>
            <p><i class="fa fa-fw fa-map-marker"></i> Dundee</p>
                
            <p><i class="fa fa-fw fa-user"></i> Dylan Baker</p>
            <p><i class="fa fa-fw fa-envelope"></i> dylan@dylan-baker.software</p>
        </div>
    </div>
</footer>

<div class="st-dark-gray st-center st-padding-16"><p>Developed by Dylan Baker</p> </div>

<!-- End page content -->
</div>


<script>
    // Accordion
    function user_account() {
        var x = document.getElementById("user_account");
        if (x.className.indexOf("st-show") == -1) {
            x.className += " st-show";
        } else {
            x.className = x.className.replace(" st-show", "");
        }
    }



    // Click on the "Jeans" link on page load to open the accordion for demo purposes
    document.getElementById("myBtn").click();


    // Open and close sidebar
    function js_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function js_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>

</body>
</html>