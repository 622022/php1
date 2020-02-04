<?php 
    class User {
        public $email;
        public $fullname;
        public $password;

        public function __construct($fullname,$email, $password) {
            $this->email = $email;
            $this->fullname = $fullname;
            $this->password = $password;
        }
    }
?> 