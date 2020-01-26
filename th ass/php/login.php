<?php
    session_start();
    require_once("loginservice.php");
    $loginService = loginService::getInstance();

    $email = $_POST["login-email"];
    $password = $_POST["login-password"];

    if (isset($_POST["login"])) {
        try {
            $loginSuccess = $loginService->login($email, $password);
            header("Location: ../index.php");
        } catch (Exception $e) {
            echo ("Server error: '$e->message'");
        }

        if ($loginSuccess) {
            echo ("Successfully logged in.");
        } else {
            echo ("Invalid login.");
        }
    } else if ($_POST["reset"]) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loginService->resetPass($email);
        }
    } else {
        echo("Invalid action");
    }
?>