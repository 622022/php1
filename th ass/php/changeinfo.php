<?php
    session_start();
    require_once("loginservice.php");

    $loginService = loginService::getInstance();

    $email = $_POST["change-email"];
    $password = $_POST["change-password"];

    if (strlen($password) > 0) {
        $loginService->setEmail($loginService->getActiveUser(), $email);
        $loginService->setPasswordByEmail($email, $password);
    } else {
        echo("Your password cannot be empty!");
    }

    $loginService->logout();
?>