<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <div class="form">
            <h1>Log In</h1>
            <form action="controller.php" method="post">
                <input type="text" name="login-email" placeholder="email" required />
                <input type="password" name="login-password" placeholder="password" required />
                <input name="login-button" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
    </body>
</html>