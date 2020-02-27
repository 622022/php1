<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <link rel="stylesheet" href="css/main.css"/>
    </head>
    <body>

        <div class="form">
            <h1>Registration</h1>
            <form name="registration-form" action="controller/user-controller.php" method="post">
                <input type="text" name="reg_fullname" placeholder="Full Name" required/>
                <input type="email" name="reg_email" placeholder="Email" required/>
                <input type="password" name="reg_password" placeholder="Password" required/>
                <input type="submit" name="register-button" value="Register"/>
            </form>
    </body>
</html>