<?php
    if($_SERVER["REQUEST_METHOD"] !== 'OPTIONS' && $_SERVER["REQUEST_METHOD"] !== 'DELETE') {
        http_response_code(400);
        echo "Only DELETE method is allowed";
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require_once "../objects/notification.php";
    $notifications = Notification::deleteAll();
    echo json_encode(
        array("message" => "Table truncated.")
    );
?>