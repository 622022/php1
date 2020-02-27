<?php
    session_start();
    require_once(__DIR__ . "/service/loginservice.php");
    require_once(__DIR__ . "/service/searchService.php");
    $loginService = loginService::getInstance();
    $searchService = searchService::getInstance();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" />

    </head>
    <body>
        <div id="loginForm" class="form">
            <h1>Log In</h1>
            <form id="loginForm" action="index.php" method="post" >
                <input id="log-email" type="text" name="login-email" placeholder="email" required />
                <input type="password" name="login-password" placeholder="password" required />
                <input name="login-button" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='src/registration.php'>Register Here</a></p>
            <p>Forgot Password? <a href='src/requestpass.php'>Click here.</a></p>
        </div>
        <?php
        if (isset($_POST["login-button"])) {
        try {
            if($loginService->login($_POST['login-email'], $_POST['login-password']))
            {
                header("Location: ./src/dashboard.php");
            }
            else
            {
                echo'<h2>Invalid login Please check your email and/or password.</h2> <a href="../index.php">click here to return and retry</a>';

            }
            
        } catch (Exception $e) {
            echo ("Error: '$e->message'");
        }
    }
        ?>
    
        
    </body>
</html>