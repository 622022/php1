<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<?php
    require_once("../src/dal.php");
    require_once("../model/usermodel.php");
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
                $username = $this->dal->getName($email);
                //$username = $email;
    
                if ($hashedPass && password_verify($password, $hashedPass)) {
                    session_start();
                    $_SESSION['USER'] = $username;
                    $_SESSION['EMAIL'] = $email;
                    return true;
                } else {
                    //echo("bad login");
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

            
            public function checkSession(){
                if (session_status() == PHP_SESSION_ACTIVE) {
                    return isset($_SESSION['USER']) ? $_SESSION['USER'] : null;
                } else {
                    Echo("Log in first!");
                }
            }

            public function captcha()
            {
                if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
                {
                $secret = '6LcX2NcUAAAAAMmdE7D0avRDRxHG9Osfwkplnbuv';
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                    if($responseData->success)
                    {
                        return true;
                    }
                    else
                    {
                        echo("Captcha unsuccessfull");
                        return false;
                    }
                }
            }

            public function updateEmail($oldEmail,$newEmail)
            {
                $this->dal->changeEmail($oldEmail,$newEmail);
            }

            public function updateName($newName,$userEmail)
            {
                $this->dal->changeName($newName,$userEmail);
            }

            public function CheckifSameTokenExists($token){
                $result=$this->dal->checkSameToken($token);
                if($result==NULL)
                {
                    return false;
                }else{
                    return true;
                }
            }

            public function checkTokenforEmailExists($email){
                $result=$this->dal->checkTokenForEmail($email);
                if($result==NULL)
                {
                    return false;
                }else{
                    return true;
                }
            }

            public function storeToken($email,$token){
                $this->dal->tokenStore($email,$token);
            }

            public function checkToken($token)
            {
                $result=$this->dal->checkifTokenExists($token);
                if($result==NULL)
                {
                    return false;
                }else{
                    return true;
                }
            }

            public function setNewPassword($pass,$token)
            {
                $this->dal->resetPass(password_hash($pass, PASSWORD_BCRYPT),$token);
                $this->dal->dropToken($token);
            }
            

            public function logout() {
                session_destroy();
                session_unset();
                //header("login.php");
            }

            public function returnUsername()
            {
                $username= $_SESSION['USER'];
                

                return($username);
            }

            public function returnEmail()
            {
                $email= $_SESSION['EMAIL'];
                return $email;
            }

            public function returnURL($email)
            {
                $URL=$this->dal->getURL($email);
                return $URL;
            }


        }
?>
