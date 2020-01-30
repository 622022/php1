<?php
    session_start();
    require_once("loginservice.php");
    require_once("searchService.php");
    $loginService = loginService::getInstance();
    $searchService = searchService::getInstance();

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
                header("Location: login.php");
            } else {
                echo("The user with this email already exists, try logging in.");
            }
        } catch(Exception $e) {
            echo($e);
        }
    }

    // if(isset($_POST["search-button"]))
    // {   try{
    //         if($searchService->searchUsers( $_POST['searchuser']))
    //         {
    //             header("Location: searchpage.php");
    //         }
    //         // $searchService->searchAllUsers();
    //         // header("Location: searchpage.php");
            
    //     }catch(Exception $e) {
    //         echo($e);
    //     }
       
    // }

?>