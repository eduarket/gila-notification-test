<?php
    if($_SERVER["REQUEST_METHOD"] !== 'GET') {
        http_response_code(400);
        echo "Only GET method is allowed";
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../objects/notification.php";
    $notifications = Notification::read();
    $num = count($notifications);
    if($num > 0) {
        $logs_arr = array();
        $logs_arr["records"] = array();
        foreach($notifications as $notification) {
            $log = array(
                "id" => $notification->getId(),
                "messageType" => $notification->getMessageType(),
                "notificationType" => $notification->getNotificationType(),
                "message" => $notification->getMessage(),
                "userID" => $notification->getUserID(),
                "userName" => $notification->getUserName(),
                "userEmail" => $notification->getUserEmail(),
                "userPhoneNumber" => $notification->getUserPhoneNumber(),
                "created" => $notification->getCreated(),
                "sent" => $notification->getSent()
            );
            array_push($logs_arr["records"], $log);
        }
        echo json_encode($logs_arr);
    } else {
        echo json_encode(
            array("message" => "No logs found.")
        );
    }
?>