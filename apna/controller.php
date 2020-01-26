<?php
    session_start();
    require_once("loginservice.php");
    $loginService = loginService::getInstance();

    $email = $_POST["login-email"];
    $password = $_POST["login-password"];

    if (isset($_POST["login-button"])) {
        try {
            $loginSuccessfull = $loginService->login($email, $password);
            header("Location: index.php");
        } catch (Exception $e) {
            echo ("Server error: '$e->message'");
        }

        if ($loginSuccessfull) {
            echo ("Successfully logged in.");
        } else {
            echo ("Invalid login.");
        }
    } 
    if (isset($_POST["register-button"])) {
        try {
            if ($loginService->register($_POST['email'], $_POST['name'], $_POST['password'])) {
                echo("You were succesfully registered");
            } else {
                echo("This user already exists, try logging in or request a password reset");
            }
        } catch(Exception $e) {
            echo($e);
        }
    }

?>