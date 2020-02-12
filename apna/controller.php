<?php
    session_start();
    require_once("loginservice.php");
    require_once("searchService.php");
    $loginService = loginService::getInstance();
    $searchService = searchService::getInstance();

    

    if (isset($_POST["login-button"])) {
        try {
            if($loginService->login($_POST['login-email'], $_POST['login-password']))
            {
                header("Location: dashboard.php");
            }
            else
            {
                echo("Invalid login. <a href=\"login.php\">click here to return and retry</a>");

            }
            
        } catch (Exception $e) {
            echo ("Error: '$e->message'");
        }

    } 
    if (isset($_POST["register-button"])) {
        $Check=$loginService->CheckUser($_POST['register-email']);
        $Captcha_chk = $loginService->captcha();
        try {
            if ($_POST['register-password'] == $_POST['register-repassword']) {
                if($Check==false && $Captcha_chk==true){
                    echo("This email already exists. <a href=\"login.php\">Please log in.</a> ");
                }else{
                    $loginService->register( $_POST['register-name'], $_POST['register-email'], $_POST['register-password']);
                    echo("You were succesfully registered. <a href=\"login.php\">click here to return</a>.");
                }
                
            } else {
                echo("The passwords don't match,try again.");
            }
        } catch(Exception $e) {
            echo($e);
        }
    }

    if(isset($_POST["update-button"])){
        $Check=$loginService->CheckUser($_POST['new-email']);
        $oldEmail=$_SESSION['EMAIL'];
        $newEmail=$_POST['new-email'];

        try {
            if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                // Check if a user with the same email already exists first
                if ($Check == false) {
                    echo("User with email '$newEmail' already exists.");
                } else {
                    echo("Email succesfully changed, <a href=\"login.php\">click here to login again</a>.");
                }
                // Change the email
                $loginService->updateEmail($oldEmail, $newEmail);
                return true;
            } else {
                echo("Invalid email format.");
            }
        
        } catch(Exception $e) {
            echo($e);
        }
    }

    
    if (isset($_POST["logout-btn"])) {
        try {
            $loginService->logout();
            header("Location: login.php");
        } catch(Exception $e) {
            echo($e);
        }
    }
    

?>