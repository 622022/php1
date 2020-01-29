<?php
    require_once("dal.php");
    //session_start();

    class searchService{
        private static $instance;
        private $dal;

        public function __construct()
        {
            $this->dal = dataLayer::getInstance();
        }

        public static function getInstance()
        {
            return !self::$instance ? new searchService() : self::$instance;
        }

        public function searchUsers($searchuser){
            //call_user_func();
            return $this->dal->getUsers($searchuser);
        }

        public function searchAllUsers()
        {
            return $this->dal->getAllUsers();
        }
    }
?>