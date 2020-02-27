<?php
    require_once("dal.php");

    class loginService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
        }

        public static function getInstance() {
            // Initialize the singleton instance if it's not already initialized
            if (self::$instance == null) {
                self::$instance = new loginService();
            }

            return self::$instance;
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

        public function login($email, $password) {
            // Get the hashed password of this user
            $hashedPass = $this->dal->getHashedPass($email);   

            if ($hashedPass && password_verify($password, $hashedPass)) {
                $_SESSION['USER'] = $email;
                session_commit();
                return true;
            } else {
                //echo("Incorrect login details, try again.");
                return false;
            }   
        }

        public function getActiveUser() {
            if (session_status() == PHP_SESSION_ACTIVE) {
                return isset($_SESSION['USER']) ? $_SESSION['USER'] : null;
            } else {
                return false;
            }
        }

        public function logout() {
            session_destroy();
            session_unset();
        }

        public function resetPass($email) {
            // Check if a user exists first
            if ($this->dal->doesUserExist($email)) {
                // Make sure no reset code exists for this email already
                if (!$this->dal->getResetCodeForEmail($email)) {
                    // Generate a unique id for the reset code
                    $token = uniqid("", true);
                    // Regenerate the reset code if it's already used by another email
                    while ($this->dal->resetCodeExists($token)) {
                        $token = uniqid("", true);
                    }
                    // Store the reset code
                    $this->dal->storeResetCodeForEmail($email, $token);
                    // Prepare and send the email
                    $message = "Hello there! We have received a password reset request for your email address.\n"
                    . "In case you requested this please click the following link http://625242.infhaarlem.nl/php/resetpass.php?token=$token\n" 
                    . "If you did not make this request you can ignore this email.";

                    mail($email, "Password reset request", $message);
                    echo("A reset link was sent to $email");
                } else {
                   echo("A reset link has already been sent for this email address");
                }
            } 
        }

        public function setPassword($token, $password) {
            $this->dal->updatePassword($this->dal->getEmailFromToken($token), $password);
            $this->dal->dropResetToken($token);
        }

        public function setPasswordbyEmail($email, $password) {
            $this->dal->updatePassword($email, $password);
        }

        public function setEmail($oldEmail, $newEmail) {
            // Validate the email before using it
            if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                // Check if a user with the same email already exists first
                if ($this->dal->doesUserExist($newEmail)) {
                    echo("User with email '$newEmail' already exists.");
                } else {
                    echo("Email succesfully changed, <a href=\"../index.php\">click here to continue</a>.");
                }
                // Change the email
                $this->dal->updateEmail($oldEmail, $newEmail);
                return true;
            } else {
                echo("Invalid email format.");
            }
        }

        public function doesTokenExist($token) {
            return $this->dal->resetCodeExists($token);
        }
    }
?>