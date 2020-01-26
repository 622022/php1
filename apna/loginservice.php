<?php
    require_once("dal.php");
    require_once("usermodel.php");

        class loginService {
            private static $instance;
            private $dal;

            public function __construct() {
                $this->dal = dataLayer::getInstance();
            }

            // calling/initializing if not already initialized(singleton pattern)
            public static function getInstance() {
            return !self::$instance ? new loginService() : self::$instance;
            }

            public function login($email, $password) {
                $hashedPass = $this->dal->getPassForUser($email);

                if ($hashedPass && password_verify($password, $hashedPass)) 
                {
                    $_SESSION['USER'] = $email;
                    session_commit();
                    return true;
                }
                else{
                    return false;
                }
            }

            public function register($email, $password) {
                // Validate the email before using it
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Checking if user already exists or not
                    if ($this->dal->CheckUserExist($email)) {
                        echo("User with email '$email' already exists.");
                    } else {
                        echo("User succesfully registered");
                    }
    
                    // Register user in db
                    $this->dal->registerUser($email, $password);
                    return true;
                } else {
                    echo("Invalid email format.");
                }
            }

        }
?>