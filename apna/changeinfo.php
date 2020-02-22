<?php
session_start();
echo ("Welcome ") . $_SESSION['EMAIL'] . "!";
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
        <form name="changeinfo-form" action="controller.php" method="post">
                <input type="text" name="change-name" placeholder="Your New Name"/>
                <input type="submit" name="update-name" value="Update"/>
                <input id="check" type="email" name="new-email" placeholder="Email" />
                <input id="check" type="submit" name="update-email" value="Update"/>
        </form>

        <div class="fb-page" data-href="https://www.facebook.com/youtube/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/youtube/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/youtube/">YouTube</a></blockquote></div>

        <form action="controller.php" method="post">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
        
    </body>
</html>
<?php } else{
    Echo("You are not logged in!<a href=\"login.php\">click here to login again</a>.");
} 
?>