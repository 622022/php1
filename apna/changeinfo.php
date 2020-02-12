<?php
session_start();
echo ("Welcome ") . $_SESSION['EMAIL'] . "!";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <header>
            <div class="topnav">
                <a class="active" href="dashboard.php">Home</a>
                <a href="PHP 2">PHP2</a>
                <a href="changeinfo.php">Update info</a>
                </div>
        </header>
        <form name="changeinfo-form" action="controller.php" method="post">
                <input type="text" name="change-name" placeholder="Your New Name" required/>
                <input type="email" name="new-email" placeholder="Email" required/>
                <input type="password" name="old-password" placeholder="Password" required/>
                <input type="password" name="new-repassword" placeholder="Retypepassword" required />
                <input type="submit" name="update-button" value="Update"/>
        </form>

        <form action="controller.php" method="post">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
        
    </body>
</html>