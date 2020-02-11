<!DOCTYPE html>
<html>
    <head>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <div class="g-recaptcha" data-sitekey="6LcX2NcUAAAAAEXBSrzol9OMXHYaYnZV6Qv6y706"></div>
                <input type="submit" name="register-button" value="Register"/>
            </form>
    </body>
    
</html>