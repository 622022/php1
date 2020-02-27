<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" />

    </head>
    <body>
        <!-- //login form which submits data to controller for login and calls validate form method to validate email using Javascript -->
        <div id="loginForm" class="form">
            <h1>Log In</h1>
            <form id="loginForm" action="controller/controller.php" method="post" >
                <input id="log-email" type="text" name="login-email" placeholder="email" required />
                <input type="password" name="login-password" placeholder="password" required />
                <input name="login-button" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='src/registration.php'>Register Here</a></p>
            <p>Forgot Password? <a href='src/requestpass.php'>Click here.</a></p>
        </div>

        
        
    </body>
</html>