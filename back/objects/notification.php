<?php
    require_once "../config/DBConnection.php";
    
    class Notification {
    
        private $conn;
        private $table_name = "notifications_logs";
    
        protected $id;
        protected $messageType;
        protected $notificationType;
        protected $message;
        protected $userID;
        protected $userName;
        protected $userEmail;
        protected $userPhoneNumber;
        protected $created;
        protected $sent;

        public function __construct($row) {
            $this->id = $row["id"];
            $this->messageType = $row["messageType"];
            $this->notificationType = $row["notificationType"];
            $this->message = $row["message"];
            $this->userID = $row["userID"];
            $this->userName = $row["userName"];
            $this->userEmail = $row["userEmail"];
            $this->userPhoneNumber = $row["userPhoneNumber"];
            $this->created = $row["created"];
            $this->sent = $row["sent"];
        }

        function read() {
            $db = DBConexion::connection();
            $data = $db->query("SELECT * FROM `notifications_logs` ORDER BY id DESC");
            $notifications = array();
            while($row = $data->fetch_assoc()) {
                $notification = new Notification($row);
                $notifications[] = $notification;
            }
            return $notifications;
        }

        function create() {
            $this->messageType = htmlspecialchars(strip_tags($this->messageType));
            $this->notificationType = htmlspecialchars(strip_tags($this->notificationType));
            $this->message = htmlspecialchars(strip_tags($this->message));
            $this->userID = htmlspecialchars(strip_tags($this->userID));
            $this->userName = htmlspecialchars(strip_tags($this->userName));
            $this->userEmail = htmlspecialchars(strip_tags($this->userEmail));
            $this->userPhoneNumber = htmlspecialchars(strip_tags($this->userPhoneNumber));
            $channel = strtolower(str_replace(array(' ', '-'), array('', ''), $this->notificationType));
            require_once '../objects/channels/'.$channel.'.php';
            $refl = new ReflectionClass('Notification'.$channel);
            $instance = $refl->newInstanceArgs([
                $this->userName,
                $this->userEmail,
                $this->userPhoneNumber,
                $this->message
            ]);
            $this->sent = $instance->send();
            $db = DBConexion::connection();
            $db->query("INSERT INTO notifications_logs (messageType, notificationType, message, userID, userName, userEmail, userPhoneNumber, sent) VALUES ('".$this->messageType."', '".$this->notificationType."', '".$this->message."', '".$this->userID."', '".$this->userName."', '".$this->userEmail."', '".$this->userPhoneNumber."', '".$this->sent."');");
            if($this->sent == 1) {
                return true;
            } else {
                return false;
            }
        }

        function deleteAll() {
            $db = DBConexion::connection();
            $db->query("TRUNCATE TABLE notifications_logs;");
            return true;
        }

        public function getId() {
            return $this->id;
        }

        public function getMessageType() {
            return $this->messageType;
        }

        public function getNotificationType() {
            return $this->notificationType;
        }

        public function getMessage() {
            return $this->message;
        }

        public function getUserID() {
            return $this->userID;
        }

        public function getUserName() {
            return $this->userName;
        }

        public function getUserEmail() {
            return $this->userEmail;
        }

        public function getUserPhoneNumber() {
            return $this->userPhoneNumber;
        }

        public function getCreated() {
            return $this->created;
        }

        public function getSent() {
            return $this->sent;
        }
    }