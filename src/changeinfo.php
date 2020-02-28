<!-- //check before every page to see if user is logged in before accessing it. -->
<?php
session_start();
require_once("../service/loginservice.php");
$loginService = loginService::getInstance();
if ($loginService->checkSession())
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Change info page</title>
        <link rel="stylesheet" href="../css/main.css" />
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>
        <!-- //navbar.html file being called using javascript on every page. -->
            <!--Navigation bar-->
            <div id="nav-placeholder">

            </div>

            <script>
            $(function(){
            $("#nav-placeholder").load("nav.html");
            });
            </script>
            <!--end of Navigation bar-->
        </header>
        <form name="changeinfo-form" action="../controller/controller.php" method="post">
                <input type="text" name="change-name" placeholder="Your New Name"/>
                <input type="submit" name="update-name" value="Update"/>
                <input id="check" type="email" name="new-email" placeholder="Email" />
                <input id="check" type="submit" name="update-email" value="Update"/>
        </form>


        <form action="javascript:void(0);" method="post" name="logout-form" Id="logout-form">
            <button id="logout-button"type="submit" name="logout-btn" onclick="Confirm()">Logout </button>
        </form>

        <script>
        function Confirm() {
            var r = confirm("You will be logged out. \n Are you sure?");
            if (r == true) {
                document.getElementById("logout-form").action = "../controller/controller.php";
            } else {
                header("Location: dashboard.php");
            }
        }
        </script>
        
    </body>
</html>
<?php } else{
    Echo("You are not logged in!<a href=\"../index.php\">click here to login again</a>.");
} 
?>