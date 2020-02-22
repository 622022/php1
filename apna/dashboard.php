<?php
session_start();
require_once("loginservice.php");
$loginService = loginService::getInstance();
if ($loginService->checkSession())
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0"></script>
        <header>
            <div class="topnav">
                <a class="active" href="dashboard.php">Home</a>
                <a href="ticketpage.php">Ticket Purchase</a>
                <a href="changeinfo.php">Update info</a>
                <a href="uploadpage.html">Image Upload</a>
                </div>
        </header>
        <?php
        
        echo ("Welcome ") . $_SESSION['USER'] . "!";
        
        ?>
        <h4>Users can be searched here!</h4>
        <form action="searchpage.php" method ="post">
            Username<input type="text" name="search-name" placeholder="Name to be searched" required>
            <!-- Useremail<input type="text" name="search-email">
            Register date<input type="text" name="search-date"> -->
            <button type="submit" name="search-button"> Search user</button>  
        </form>

        <div class="fb-page" data-href="https://www.facebook.com/youtube/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/youtube/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/youtube/">YouTube</a></blockquote></div>


        <form action="javascript:void(0);" method="post" name="logout-form" Id="logout-form">
            <button id="logout-button"type="submit" name="logout-btn" onclick="Confirm()">Logout </button>
        </form>

        <script>
        function Confirm() {
            var r = confirm("You will be logged out. \n Are you sure?");
            if (r == true) {
                document.getElementById("logout-form").action = "controller.php";
            } else {
                header("Location: dashboard.php");
            }
        }
        </script>
<?php } else{
    Echo("You are not logged in!<a href=\"login.php\">click here to login again</a>.");
} 
?>
    </body>
</html>