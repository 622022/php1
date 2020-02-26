
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
        <title>Ticket Page</title>
        <link href="../css/main.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>

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

        <section class="eventcard">
		  <div class="box-container">
		  <img src="https://www.funx.nl/images/2017/12/19_ae_Nicky-Romero-press-photo-cr-Marte-Visser-2017-billboard-1548.jpg" alt="some description">
		  <h2>€60.00</h2>
		  <button id="buybtn" type="button" name="Buy ticket" >Buy Ticket</button>
		  <h3>Dance by Nicky Romero</h3>
		  <h4>Jopenkerk</h4>
		  <h4>22:00-3:00</h4>
		</section>

        <script>
        document.getElementById("buybtn").onclick = function () {
        location.href = "payment.php";
        };
        </script>

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