<?php
    require_once("credentials.php");


    class dataLayer{
        private static $instance;
        private $conn;
        
        public function __construct(){
            $this->conn = mysqli_connect(servername, username, password, databasename);
        }

        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        public function getPassForUser($email)
        {
            
            $query = $this->conn->prepare("SELECT password FROM users WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                return $result->num_rows > 0;
            }
        }

        public function registerUser($email, $password) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $query->bind_param('sss', $user->fullname, $user->email, $user->password);
            $query->execute();

            return $query->affected_rows == 1;
        }

        public function CheckUserExist($email)
        {
            $query = $this->conn->prepare("SELECT email FROM users WHERE email = ?");
            $query->bind_param('s' , "$email");
            $query->execute();
            $result = $query->get_result();

            if (!$result)
            {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            }
            else
            {
                return $result->num_rows > 0;
            }
        }

    }
   
?>
