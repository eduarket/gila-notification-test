<?php
    if($_SERVER["REQUEST_METHOD"] !== 'GET') {
        http_response_code(400);
        echo "Only GET method is allowed";
        exit();
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../objects/user.php";
    $users = User::readByMessageType('All');
    $num = count($users);
    $users_arr = array();
    if($num > 0) {
        $users_arr["records"] = array();
        foreach($users as $item) {
            $user = array(
                "id" => $item->getId(),
                "name" => $item->getName(),
                "email" => $item->getEmail(),
                "phoneNumber" => $item->getPhoneNumber(),
                "suscribed" => $item->getSuscribed(),
                "channels" => $item->getChannels()
            );
            array_push($users_arr["records"], $user);
        }
    }
    echo json_encode($users_arr);
?>