<?php
    session_start();
    require_once("loginservice.php");

    $loginService = loginService::getInstance();

    $loginService->logout();
        
    //     header("Location: login.php");
    // } else {
    //     echo("You are not logged in.");
    //     header("Location: login.php");
    // }
?>