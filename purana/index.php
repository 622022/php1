<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <div class="form">
            <h1>Log In</h1>
            <form action="controller/user-controller.php" method="post" name="login-form">
                <input type="text" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input name="login-button" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
    </body>
</html>