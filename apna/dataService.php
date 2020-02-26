<?php
    require_once("dal.php");
    //session_start();


        class dataService {
            private static $instance;
            private $dal;

            public function __construct() {
                $this->dal = dataLayer::getInstance();
            }

            // calling/initializing if not already initialized(singleton pattern)
            public static function getInstance() {
            return !self::$instance ? new dataService() : self::$instance;
            }

            public function getData()
            {
                return $this->dal->getDataforExport();
            }
        }
?>