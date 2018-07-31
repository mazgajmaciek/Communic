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

    $sentPrvMsgsArray = Privatemessage::loadAllPrivateMessagesBySenderId($conn, isset($userId) ? $userId : null);
    $jsonSentPrvMsgs = [];
    foreach ($sentPrvMsgsArray as $prvMsg) {
        $jsonSentPrvMsgs[] = json_decode(json_encode($prvMsg), true);
    }

    $response = ['success' => $jsonRcvdPrvMsgs,
        'sentPrvMsgs' => $jsonSentPrvMsgs];

}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    $userId = $_SESSION['userId'];
    parse_str(file_get_contents("php://input"), $patchVars);
    $privateMessage = Privatemessage::loadPrivateMessageById($conn, $patchVars['prvMsgId']);

    $privateMessage->setReadStatus($patchVars['readStatus']);
    $privateMessage->saveToDB($conn);

    $response = ['success' => $privateMessage];
}