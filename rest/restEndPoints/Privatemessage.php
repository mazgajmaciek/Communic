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