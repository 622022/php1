<?php
    require_once("dal.php");
    //require_once("user_model.php");

        class loginService {
            private static $instance;
            private $dal;

            public function __construct() {
                $this->dal = dataLayer::getInstance();
            }

            // Initialize instance if not already intitialized. Then returns that instance.
            public static function getInstance() {
            return !self::$instance ? new loginService() : self::$instance;
            }

            public function login($email, $password) {
                $hashedPass = $this->dal->getHashedPass($email);

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
                    // Check if a user with the same email already exists first
                    if ($this->dal->doesUserExist($email)) {
                        echo("User with email '$email' already exists.");
                    } else {
                        echo("User succesfully registered, <a href=\"../index.php\">click here to continue</a>.");
                    }
    
                    // Register the user in the database
                    $this->dal->registerUser($email, $password);
                    return true;
                } else {
                    echo("Invalid email format.");
                }
            }
        }