<?php 
    session_start();
    require_once("loginservice.php");
    $loginService = loginService::getInstance();

    if ($loginService->doesTokenExist($_GET["token"])) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Thomas's very epic password reset page</title>
        <link rel="stylesheet" href="css/main.css">
        <meta charset="UTF-8">
        <meta name="description" content="This is a very epic pass reset page"/>
    </head>
    <body>
        <form action="setpass.php" method="post">
            <input type="hidden" name="token" value=<?php echo($_GET["token"]); ?>>
            New password
            <input type="password" name="new-password">
            <br>
            <input type="submit" value="Confirm">
        </form>
    </body>
</html>
<?php 
    } else { 
        echo("This token does not exist.");
    }
?>