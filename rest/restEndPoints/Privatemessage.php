<?php
session_start();

header('Content-Type: application/json');//return json header

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $userId = $_SESSION['userId'];
    $rcvdPrvMsgsArray = Privatemessage::loadAllRcvdPrvMsgsByUserId($conn,isset($userId) ? $userId : null);
    $jsonRcvdPrvMsgs = [];
    foreach ($rcvdPrvMsgsArray as $prvMsg) {
        $jsonRcvdPrvMsgs[] = json_decode(json_encode($prvMsg), true);
    }

    $response = ['success' => $jsonRcvdPrvMsgs];
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    $userId = $_SESSION['userId'];
//    $rcvdPrvMsgsArray = Privatemessage::loadAllRcvdPrvMsgsByUserId($conn,isset($userId) ? $userId : null);
//    $jsonRcvdPrvMsgs = [];
//    foreach ($rcvdPrvMsgsArray as $prvMsg) {
//        $jsonRcvdPrvMsgs[] = json_decode(json_encode($prvMsg), true);
//    }
    parse_str(file_get_contents("php://input"), $patchVars);
    //TODO - front-end returns only message id - add array key in ajax to return read status 0/1
    var_dump($patchVars);

    $privateMessage = Privatemessage::loadPrivateMessageById($conn, $privateMessageId);

    $privateMessage->setReadStatus(1);
    $privateMessage->saveToDB($conn);

    $response = ['success' => $jsonRcvdPrvMsgs];
}