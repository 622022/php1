<?php
    require_once("credentials.php");
    require_once("usermodel.php");


    class dataLayer{
        private static $instance;
        private $conn;
        
        public function __construct(){
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);
        }

        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        private function executeQuery($query, $params, ...$variables) {
            $stmt = $this->conn->prepare($query);
            if (isset($params) && count($variables) > 0) {
                $stmt->bind_param($params, ...$variables);
            }
            $stmt->execute();

            $error = $this->conn->error;
            if ($error) {
                throw new Exception("Database error: '$error'");
            }

            return $stmt;
        }

        private function executeSelectQuery($query, $params, ...$variables) {
            return $this->executeQuery($query, $params, ...$variables)->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        private function executeEditQuery($query, $params, ...$variables) {
            return $this->executeQuery($query, $params, ...$variables)->affected_rows;
        }

        public function getPassForUser($email)
        {
            
            $query = $this->conn->prepare("SELECT password FROM users WHERE email = ? ");
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

        public function registerUser($user) {
            $query = "
                INSERT INTO users (name, email, password)
                VALUES (?, ?, ?)
            ";

            return $this->executeEditQuery($query, 'sss', $user->fullname, $user->email, $user->password) == 1;
        }

        public function getHashedPass($email) {
            $query = "
                SELECT password
                FROM users
                WHERE email = ?
            ";

            return $this->executeSelectQuery($query, 's', $email)[0]["password"];
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

        public function getName($email)
        {
            $query = "
                SELECT name
                FROM users
                WHERE email = ?
            ";

            return $this->executeSelectQuery($query, 's', $email)[0]["name"];
        }

        public function changeEmail($oldEmail,$newEmail){
            $query = "
            UPDATE users
            SET email = ?
            WHERE
            email = ?
            ";

            return $this->executeEditQuery($query, 'ss', $newEmail,$oldEmail) == 1;

        }

    }
   
?>
