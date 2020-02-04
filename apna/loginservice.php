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
                //$password = password_hash($password, PASSWORD_DEFAULT);
                $hashedPass = $this->dal->getPassForUser($email);
                //$hashedPass = '$2y$10$CiDPVSU6BPr7BrEEkKxcveJbwDFQZQplwg/lfT/4qv/Jd2Gf8HZSe';
                //echo " password is $password \n ";
                //if($this->dal->getPassForUser($email, $password))
                // {
                //     session_start();
                //     return true;
                // }

                echo("hashed pass= $hashedPass and one we input: $password \n");
                $pwdChk = password_verify($password, $hashedPass);
                echo(" ------- $pwdChk----------");
                try{
                $pwdChk = password_verify('1234567', $hashedPass);
                echo("********************$pwdChk******************");
                if (password_verify('1234567', '$2y$10$123456789012345678901uhihPb9QpE2n03zMu9TDdvO34jDn6mO') )
                {
                    echo("pswd chk suvccess");
                   
                    //$_SESSION['USER'] = $email;
                    //$_SESSION["USERNAME"] = $fullname;
                    //session_commit();
                    //session_start();
                    return true;
                }
                else{
                    echo("pswd chk failing");
                    //echo(" hash pass: $hashedPass");
                    //echo(" - check: ". strval($pwdChk));
                    return false;
                }
            }
            catch(Exception $e)
            {
                    echo("...............$e..........");
            }
            }

            public function register($fullname,$email, $password) {
                // Validate the email before using it
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Checking if user already exists or not
                    if ($this->dal->CheckUserExist($email)) {
                        echo("User with this email '$email' already exists.");
                    } else {
                        echo("User succesfully registered");
                    }
    
                    // Register user in db
                    $password='1234567';
                    $this->dal->registerUser($fullname,$email, $password);
                    return true;
                } else {
                    echo("Invalid email format.");
                }
            }

            public function logout() {
                session_destroy();
                session_unset();
                header("login.php");
            }

        }
?>