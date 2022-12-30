<?php
    class Notificationemail {
    
        protected $userName;
        protected $userEmail;
        protected $message;

        public function __construct($userName, $userEmail, $userPhoneNumber, $message) {
            $this->userName = $userName;
            $this->userEmail = $userEmail;
            $this->message = $message;
        }

        function send() {
            return rand(0, 1);
        }

        public function getUserName() {
            return $this->userName;
        }

        public function getEmail() {
            return $this->userEmail;
        }

        public function getMessage() {
            return $this->message;
        }
    }