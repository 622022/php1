<?php
    require_once("dal.php");
    require_once("usermodel.php");
    //session_start();


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
                $hashedPass = $this->dal->getHashedPass(strtolower($email));
    
                if ($hashedPass && password_verify($password, $hashedPass)) {
                    session_start();
                    $_SESSION['USER'] = $email;
                    return true;
                } else {
                    echo("bad login");
                    return false;
                }
            }

            public function register($fullname,$email,$password) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {   try {
                    return $this->dal->registerUser(new User($fullname,$email, password_hash($password, PASSWORD_BCRYPT)));
                } catch(Exception $e) {
                    echo($e);
                }
            }
            else {
                throw new Exception("Invalid email format");
            }
            }   
            
            
            public function CheckUser($email)
            {
                if(!$this->dal->CheckUserExist($email)){
                    return true;
                }
                else{
                    return false;
                }
            }

            public function logout() {
                session_destroy();
                session_unset();
                header("login.php");
            }

        }
?>