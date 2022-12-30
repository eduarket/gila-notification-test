<?php
    class User {
    
        protected $id;
        protected $name;
        protected $email;
        protected $phoneNumber;
        protected $suscribed;
        protected $channels;

        public function __construct($row) {
            $this->id = $row["id"];
            $this->name = $row["name"];
            $this->email = $row["email"];
            $this->phoneNumber = $row["phoneNumber"];
            $this->suscribed = $row["suscribed"];
            $this->channels = $row["channels"];
        }

        function readByMessageType($messageType) {
            $usersMock = [
                new User([
                    "id" => 1,
                    "name" => "John",
                    "email" => "john@doe.com",
                    "phoneNumber" => "+1435551234",
                    "suscribed" => [
                        "Sports"
                    ],
                    "channels" => [
                        "SMS",
                        "E-mail"
                    ]
                ]),
                new User([
                    "id" => 2,
                    "name" => "Laura",
                    "email" => "laura@thompson.com",
                    "phoneNumber" => "+1435551235",
                    "suscribed" => [
                        "Movies"
                    ],
                    "channels" => [
                        "Push Notification"
                    ]
                ]),
                new User([
                    "id" => 3,
                    "name" => "Bob",
                    "email" => "bob@norton.com",
                    "phoneNumber" => "+1435551236",
                    "suscribed" => [
                        "Sports",
                        "Finance"
                    ],
                    "channels" => [
                        "E-mail",
                        "Push Notification"
                    ]
                ])
            ];
            $return = [];
            if($messageType == 'All') {
                $return = $usersMock;
            } else {
                foreach($usersMock as $userMock) {
                    $categories = $userMock->getSuscribed();
                    foreach($categories as $category) {
                        if($messageType == $category) {
                            $return[] = $userMock;
                        }
                    }
                }
            }
            return $return;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function getSuscribed() {
            return $this->suscribed;
        }

        public function getChannels() {
            return $this->channels;
        }
    }