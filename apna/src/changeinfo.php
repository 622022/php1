<?php
session_start();
//echo ("Welcome ") . $_SESSION['EMAIL'] . "!";
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
        <!-- <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0"></script> -->
        <header>
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

        <!-- <div class="fb-page" data-href="https://www.facebook.com/youtube/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/youtube/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/youtube/">YouTube</a></blockquote></div> -->

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