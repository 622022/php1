<?php
    session_start();
    require_once("loginservice.php");
    $loginService = loginService::getInstance();

    $token = $_POST["token"];
    $pass = $_POST["new-password"];

    $loginService->setPassword($token, $pass);
    echo("Your password was updated, <a href=\"../index.php\">click here to return</a>.");
?>