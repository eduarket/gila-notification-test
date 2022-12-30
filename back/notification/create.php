<?php
    if($_SERVER["REQUEST_METHOD"] !== 'POST') {
        http_response_code(400);
        echo "Only POST method is allowed";
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $data = $_POST;
    require_once "../objects/user.php";
    $users = User::readByMessageType($data['messageType']);
    $messagesSent = 0;
    $messagesFailed = 0;
    if($users) {
        require_once "../objects/notification.php";
        foreach($users as $user) {
            $channels = $user->getChannels();
            foreach($channels as $channel) {
                $notification = new Notification([
                    "messageType" => $data['messageType'],
                    "notificationType" => $channel,
                    "message" => $data['message'],
                    "userID" => $user->getId(),
                    "userName" => $user->getName(),
                    "userEmail" => $user->getEmail(),
                    "userPhoneNumber" => $user->getPhoneNumber()
                ]);
                if($notification->create()) {
                    $messagesSent++;
                } else {
                    $messagesFailed++;
                }
            }
        }
        echo json_encode(
            array("message" => $messagesSent . " message(s) sent. " . $messagesFailed . " message(s) failed.")
        );
    } else {
        echo json_encode(
            array("error" => "No Users in " . $data['messageType'])
        );
    }
?>