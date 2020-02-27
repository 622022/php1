<?php
    session_start();
    require_once("php/loginservice.php");
    require_once("php/searchservice.php");

    $loginService = loginService::getInstance();
    $searchService = searchService::getInstance();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Thomas's very epic PHP website</title>
        <link rel="stylesheet" href="css/main.css">
        <meta charset="UTF-8">
        <meta name="description" content="This is a website that contains very epic PHP code"/>
    </head>
    <body>
        <header>
            <p> <?php echo($loginService->getActiveUser() ? "You're logged in as " . $loginService->getActiveUser() : "")?> </p>
            <?php if (!$loginService->getActiveUser()) { // Start hiding if logged in?>
            <h1>Login</h1>
            <form action="php/login.php" method="post">
                Email
                <input type="text" name="login-email">
                Password
                <input type="password" name="login-password">
                <br>
                <input type="submit" value="Login" name="login">
                <input type="submit" value="Forgot Password" name="reset">
            </form>
            <h1>Register</h1>
            <form action="php/register.php" method="post">
                Email
                <input type="text" name="register-email">
                Password
                <input type="password" name="register-password">
                <br>
                <img src="img/captcha.jpg" alt="captcha">
                <br>
                Captcha
                <input type="text" name="captcha">
                <br>
                <button type="submit">Register</button>
            </form>
            <?php } else { // End hiding if logged in, start showing if logged in?>
            <form action="php/logout.php" method="post">
                <button type="submit">Logout</button>
            </form>
            <form action="php/searchusers.php" method="post">
                <input type="text" name="query">
                <button type="submit">Search users</button>
            </form>
            <h2>Users</h2>
            <table>
                <?php 
                    $userArray = $searchService->searchAllUsers();
                    for ($i=0; $i < sizeof($userArray); $i++) { 
                        echo("<tr><th>" . $userArray[$i]["email"] . "</tr></th>");
                    }
                ?>
            </table>
            <h2>Change account info</h2>
            <form action="php/changeinfo.php" method="post">
                New Email
                <input type="text" name="change-email">
                New Password
                <input type="password" name="change-password">
                <button type="submit">Confirm</button>  
            </form>
            <?php } // End showing if logged in ?>
        </header>
        <h1>Welcome to this epic site of epicness</h1>
        <p>Here's a very epic DANCING DOG!!!</p>
        <img src="img/dog.gif" alt="dog">
    </body>
</html>