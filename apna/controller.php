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

    if(isset($_POST["update-email"])){
        $Check=$loginService->CheckUser($_POST['new-email']);
        $oldEmail=$_SESSION['EMAIL'];
        $newEmail=$_POST['new-email'];
        

        try {
            if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                // Check if a user with the same email already exists first
                if ($Check == false) {
                    echo("User with email '$newEmail' already exists.");
                } else {
                    echo("Email and name succesfully changed, <a href=\"login.php\">click here to login again</a>.");
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

    if(isset($_POST["update-name"])){
        $oldEmail=$_SESSION['EMAIL'];
        $newName=$_POST['change-name'];
        try{
            if($newName==NULL){
                Echo("The name can not be null!");
            }
            else{
                $loginService->updateName($newName,$oldEmail);
                Echo("Name successfully changed to $newName!");
                echo("<a href=\"changeinfo.php\">Go back</a>.");
            }
        }catch(Exception $e) {
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

    if(isset($_POST["reqpass-button"])){
        try{
            $email=$_POST['resetpass-email'];
            // $Check=$loginService->CheckUser($_POST['resetpass-email']);
            // if($Check == false){
                //checks if the token already exists for the given email
                if($loginService->checkTokenforEmailExists($email) == false){
                    $token = uniqid("", true);
                    //checks if the same value of token exists for an email
                    if($loginService->CheckifSameTokenExists($token) == false){
                        $token = uniqid("", true);
                    }
                    $loginService->storeToken($email,$token);
                    $message = "Hello! Here is the link for you to reset your password http://622022.infhaarlem.nl/resetpass.php?token=$token\n" 
                    . "Follow the link to change your password.";

                    mail($email, "Password reset request", $message);
                    echo("A reset link was sent to $email");
                }else{
                    echo("The token for this email already exists!");
                }
                
            // }else{
            //     echo("This email does not exist.You can register for this email");
            // }
        }catch(Exception $e) {
            echo($e);
        }
    }
    

?>