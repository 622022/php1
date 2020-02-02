<?php
    session_start();
    require_once("loginservice.php");
    require_once("searchService.php");
    $loginService = loginService::getInstance();
    $searchService = searchService::getInstance();

    $email=$_POST['login-email'];
    $pass= $_POST['login-password'];

    if (isset($_POST["login-button"])) {
        try {
            if($loginService->login($_POST['login-email'], $_POST['login-password']))
            {
                header("Location: dashboard.php");
            }
            else
            {
                echo("$email $pass");

            }
            
        } catch (Exception $e) {
            echo ("Error: '$e->message'");
        }

    } 
    if (isset($_POST["register-button"])) {
        try {
            if ($loginService->register( $_POST['register-name'], $_POST['register-email'], $_POST['register-password'])) {
                echo("You were succesfully registered. <a href=\"login.php\">click here to return</a>.");
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
    if (isset($_POST["logout-btn"])) {
        try {
            $loginService->logout();
        } catch(Exception $e) {
            echo($e);
        }
    }

?>