<?php
    session_start();
    require_once("loginservice.php");

    $loginService = loginService::getInstance();

    // Check if captcha correct to prevent spam
    if ($_POST["captcha"] == "let me pass") {
        // Pass the form fields to the Data Access Layer to register user
        $loginService->register($_POST["register-email"], $_POST["register-password"]);
    } else {
        echo("Captcha incorrect, please retry");
    }
?>