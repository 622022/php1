<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
        <div id="loginForm" class="form" onsubmit="return validateForm()">
            <h1>Log In</h1>
            <form id="loginForm" action="controller/controller.php" method="post" onsubmit="return validateForm()">
                <input id="log-email" type="text" name="login-email" placeholder="email" required />
                <input type="password" name="login-password" placeholder="password" required />
                <input name="login-button" type="submit" value="Login" onclick="validateForm()"/>
            </form>
            <p>Not registered yet? <a href='src/registration.php'>Register Here</a></p>
            <p>Forgot Password? <a href='src/requestpass.php'>Click here.</a></p>
        </div>

        <script>
            function validateForm()
            {
                var email = $("#log-email").val();
                if ((/(.+)@(.+){2,}\.(.+){2,}/.test(email)) || email=="" || email==null) { } else {
                alert("Please enter a valid email");
                return false;
                }
                document.getElementById("loginForm").submit();
                return true;

            }
        </script>
        
    </body>
</html>