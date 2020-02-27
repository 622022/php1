<?php
    require_once("../src/dal.php");
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

        public function searchUsers($searchname){
            
            if($this->dal->getSearchUsers($searchname))
            {
                return $this->dal->getSearchUsers($searchname);
            }
            else{
                echo("No user with this name found!");
            }
        }

        public function searchAllUsers()
        {
            return $this->dal->getAllUsers();
        }
    }
?>