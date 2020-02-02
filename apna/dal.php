<?php
    require_once("credentials.php");


    class dataLayer{
        private static $instance;
        private $conn;
        
        public function __construct(){
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
        }

        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        public function getPassForUser($email)
        {
            
            $query = $this->conn->prepare("SELECT `password` FROM users WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                //echo("$result[0]");
                echo("$result->num_rows");
                //return $result->num_rows > 0;
                return $result->fetch_row()[0];
            }
        }

        public function registerUser($fullname,$email, $password) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $query->bind_param('sss', $fullname, $email, $user->password);
            $query->execute();

            return $query->affected_rows == 1;
        }

        public function CheckUserExist($email)
        {
            $query = $this->conn->prepare("SELECT email FROM users WHERE email = ? ");
            $query->bind_param('s' , $email);
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

        public function getSearchUsers($searchname,$searchemail,$searchdate)
        {
            $param = "%$searchname%";
            $param1 = "%$searchemail%";
            $param2 = "%$searchdate%";
            //$query = $this->conn->prepare("SELECT `name`, `email`, `registration_date` FROM `users` WHERE name LIKE ? ");
            $query = $this->conn->prepare("SELECT `name` , email, registration_date FROM `users` WHERE name LIKE ? UNION SELECT `name` , email, registration_date FROM users WHERE email LIKE ? UNION SELECT `name` , email, registration_date FROM users WHERE registration_date LIKE ? ");
            $query->bind_param('sss' , $param, $param1, $param2);
            $query->execute();
            $result = $query->get_result();

            if (!$result)
            {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            }
            else
            {
                $users = array();
                if ($result->num_rows > 0) {
                    for ($i=0; $i < $result->num_rows; $i++) { 
                        $users[$i] = $result->fetch_array();
                    }
                    return $users;
                }
            }
        }

        public function getAllUsers()
        {
            $query = $this->conn->prepare("SELECT `name`, `email`, `registration_date` FROM users");
            //$query->bind_param('s' , $email);
            $query->execute();
            $result = $query->get_result();

            if (!$result)
            {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            }
            else
            {
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

    }
   
?>
