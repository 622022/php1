<?php
    session_start();
    require_once("../service/login-service.php");
    $loginService = new loginService();

    if (isset($_POST["login-button"])) {
        try {
            $loginService->login($_POST['email'], $_POST['password']);
            header("Location: ../login.php");
        } catch(Exception $e) {
            echo($e);
        }
    }

    if (isset($_POST["register-button"])) {
        try {
            $loginService->register($_POST['reg_email'], $_POST['reg_fullname'], $_POST['reg_password']);
            //header("Location: ../index.php");
        } catch(Exception $e) {
            echo($e);
        }
    }
?>