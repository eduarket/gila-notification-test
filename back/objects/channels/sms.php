<?php
    class Notificationsms {
    
        protected $userName;
        protected $userPhoneNumber;
        protected $message;

        public function __construct($userName, $userEmail, $userPhoneNumber, $message) {
            $this->userName = $userName;
            $this->userPhoneNumber = $userPhoneNumber;
            $this->message = $message;
        }

        function send() {
            return rand(0, 1);
        }

        public function getUserName() {
            return $this->userName;
        }

        public function getUserPhoneNumber() {
            return $this->userPhoneNumber;
        }

        public function getMessage() {
            return $this->message;
        }
    }