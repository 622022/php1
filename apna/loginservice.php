<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
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
                $username = $this->dal->getName($email);
                //$username = $email;
    
                if ($hashedPass && password_verify($password, $hashedPass)) {
                    session_start();
                    $_SESSION['USER'] = $username;
                    $_SESSION['EMAIL'] = $email;
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

            
            public function checkSession(){
                if (session_status() == PHP_SESSION_ACTIVE) {
                    return isset($_SESSION['USER']) ? $_SESSION['USER'] : null;
                } else {
                 return false;
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
            

            public function logout() {
                session_destroy();
                session_unset();
                //header("login.php");
            }

        }
?>
