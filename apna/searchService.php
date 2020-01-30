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

        public function searchUsers($searchname,$searchuser,$searchdate){
            //call_user_func();
            return $this->dal->getSearchUsers($searchname,$searchuser,$searchdate);
        }

        public function searchAllUsers()
        {
            return $this->dal->getAllUsers();
        }
    }
?>