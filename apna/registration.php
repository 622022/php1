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
            <form name="registration-form" action="controller.php" method="post">
                <input type="text" name="register-name" placeholder="Full Name" required/>
                <input type="email" name="register-email" placeholder="Email" required/>
                <input type="password" name="register-password" placeholder="Password" required/>
                <input type="password" name="register-repassword" placeholder="Retypepassword" required />
                <input type="submit" name="register-button" value="Register"/>
            </form>
    </body>
</html>