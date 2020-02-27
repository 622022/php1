<?php
    session_start();
    require_once("loginservice.php");

    $loginService = loginService::getInstance();

    if ($loginService->getActiveUser()) {
        $loginService->logout();
        header("Location: ../index.php");
    } else {
        echo("You are not logged in.");
    }
?>