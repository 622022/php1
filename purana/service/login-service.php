<?php
    require_once("../lib/dal.php");
    require_once("../model/user-model.php");

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

        public function register($email, $fullname, $password) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (!$this->dal->doesUserExist($email)) {
                    try {
                        if ($this->dal->registerUser(new User($email, $fullname, $password))) {
                            echo("User succesfully registered");
                        }
                    } catch(Exception $e) {
                        echo($e);
                    }
                }
            } else {
                throw new Exception("Invalid email format");
            }
        }

        public function login($email, $password) {
            $hashedPass = $this->dal->getHashedPass($email);

            if ($hashedPass && password_verify($password, $hashedPass)) {
                $_SESSION['USER'] = $email;
                session_commit();
            }
        }
    }
?>