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
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/main.css" />
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
        <fieldset>
            <legend>Multiple upload flexible</legend>
            <h1>Pick up some files to upload, and press "upload" </h1>
            <form name="form4" enctype="multipart/form-data" method="post" action="upload.php">
                <p><input type="file" name="my_field[]" value="" multiple="multiple"/></p>
                <p class="button"><input type="hidden" name="action" value="multiple" />
                <input type="submit" name="Submit" value="upload" /></p>
            </form>
            <p>Note: The uploaded and processed files/images are stored in /tmp folder</p>
        </fieldset>
    </body>
</html>
<?php } else{
    Echo("You are not logged in!<a href=\"../index.php\">click here to login again</a>.");
} 
?>