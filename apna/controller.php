<?php
    session_start();
    require_once("loginservice.php");
    $loginService = loginService::getInstance();

    if (isset($_POST["login-button"])) {
        try {
            $loginService->login($_POST['login-email'], $_POST['login-password']);
            header("Location: dashboard.php");
        } catch (Exception $e) {
            echo ("Server error: '$e->message'");
        }

    } 
    if (isset($_POST["register-button"])) {
        try {
            if ($loginService->register( $_POST['register-name'], $_POST['register-email'], $_POST['register-password'])) {
                echo("You were succesfully registered");
                //header("Location: login.php");
            } else {
                echo("The user with this email already exists, try logging in.");
            }
        } catch(Exception $e) {
            echo($e);
        }
    }

?>