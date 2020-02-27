<?php
    require_once("dal.php");

    class searchService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
        }

        public static function getInstance() {
            // Initialize the singleton instance if it's not already initialized
            if (self::$instance == null) {
                self::$instance = new searchService();
            }

            return self::$instance;
        }

        public function searchUsers($query) {
            return $this->dal->getUsers($query);
        }

        public function searchAllUsers() {
            return $this->dal->getAllUsers();
        }
    }
?>