<?php
    // Bring DB credentials into scope
    require_once("credentials.php");

    class dataLayer {
        private static $instance = null;
        private $conn = null;

        public function __construct() {
            // Attempt connection with database server
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
        }

        public static function getInstance() {
            // Initialize the singleton instance if it's not already initialized
            if (self::$instance == null) {
                self::$instance = new dataLayer();
            }

            return self::$instance;
        }

        // Check if a user with the specified email already exists
        public function doesUserExist($email) {
            // Escape input
            $email = $this->conn->escape_string($email);

            // Perform the query
            $result = $this->conn->query("SELECT email FROM User WHERE email = '$email'");

            // Check result for errors
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                // User exists if we received
                return $result->num_rows > 0;
            }
        }

        // Register a unknown user
        public function registerUser($email, $password) {
            // Prevent SQL injection using escape method
            $email = $this->conn->escape_string($email);
            // Hash and salt password to prevent storing unencrypted password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $password = $this->conn->escape_string($password);

            $status = $this->conn->query("INSERT INTO `User` (`email`, `password`) VALUES ('$email', '$password');");

            if (!$status) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            }
        }

        // Get hashed pass by email address
        public function getHashedPass($email) {
            $email = $this->conn->escape_string($email);

            $result = $this->conn->query("SELECT password FROM User WHERE email = '$email'");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        // Check if password reset token already exists
        public function resetCodeExists($code) {
            $code = $this->conn->escape_string($code);

            $result = $this->conn->query("SELECT token FROM Pass_Reset WHERE token = '$code'");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                return $result->num_rows > 0;
            }
        }

        // Get current token from email address
        public function getResetCodeForEmail($email) {
            $email = $this->conn->escape_string($email);

            $result = $this->conn->query("SELECT token FROM Pass_Reset WHERE email = '$email'");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        // Get email address from token
        public function getEmailFromToken($token) {
            $token = $this->conn->escape_string($token);

            $result = $this->conn->query("SELECT email FROM Pass_Reset WHERE token = '$token'");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        // Store reset token to user's email address
        public function storeResetCodeForEmail($email, $code) {
            $email = $this->conn->escape_string($email);
            $code = $this->conn->escape_string($code);

            $result = $this->conn->query("INSERT INTO Pass_Reset (email, token) VALUES ('$email', '$code')");

            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                return true;
            }
        }

        // Update user's email
        public function updateEmail($oldEmail, $newEmail) {
            // Prevent SQL injection using escape method
            $oldEmail = $this->conn->escape_string($oldEmail);
            $newEmail = $this->conn->escape_string($newEmail);

            $status = $this->conn->query("UPDATE `User` SET `email` = '$newEmail' WHERE `email` = '$oldEmail';");

            if (!$status) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            }
        }

        // Update user's password
        public function updatePassword($email, $password) {
            // Prevent SQL injection using escape method
            $email = $this->conn->escape_string($email);
            // Hash and salt password to prevent storing unencrypted password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $password = $this->conn->escape_string($password);

            $status = $this->conn->query("UPDATE `User` SET `password` = '$password' WHERE `email` = '$email';");

            if (!$status) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            }
        }

        // Attempt to get all users that match given search query
        public function getUsers($query) {
            $query = $this->conn->escape_string($query);

            $result = $this->conn->query("SELECT email FROM User WHERE email LIKE '%$query%';");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                $users = array();
                if ($result->num_rows > 0) {
                    for ($i=0; $i < $result->num_rows; $i++) { 
                        $users[$i] = $result->fetch_array();
                    }
                    return $users;
                } else {
                    return false;
                }
            }
        }

        // Get all users
        public function getAllUsers() {        
            $result = $this->conn->query("SELECT email FROM User;");
            if (!$result) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } else {
                $users = array();
                if ($result->num_rows > 0) {
                    for ($i=0; $i < $result->num_rows; $i++) { 
                        $users[$i] = $result->fetch_array();
                    }
                    return $users;
                } else {
                    return false;
                }
            }
        }

        public function dropResetToken($token) {
            // Prevent SQL injection using escape method
            $token = $this->conn->escape_string($token);

            $status = $this->conn->query("DELETE FROM `Pass_Reset` WHERE `token` = '$token';");

            if (!$status) {
                $error = $this->conn->error;
                error_log($error);
                throw new Exception("MySQL Error: '$error'");
            } 
        }
    }
?>