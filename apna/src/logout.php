<?php
    session_start();
    require_once("../service/loginservice.php");

    $loginService = loginService::getInstance();

    $loginService->logout();
        
  
?>