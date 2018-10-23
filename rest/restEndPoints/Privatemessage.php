<?php
session_start();

header('Content-Type: application/json');//return json header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['messagetext']))
//    require_once('../class/Privatemessage.php');
//
//    //load DB config
//    require_once '../config/db.php';
//
//    //connect to DB
//    try {
//        $conn = new PDO(
//            "mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8"
//            , DB_LOGIN, DB_PASSWORD,
//            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//        );
//    } catch (PDOException $e) {
//        $response = ['error' => 'DB Connection error: '.$e->getMessage()];
//    }

    $newPrvMessageText = $_POST["messagetext"];
    $prvMessageRecipientId = $_POST["id"];
    $prvMessageSenderId = $_SESSION["userId"];

    $newPrivateMessage = new Privatemessage($conn);
    $newPrivateMessage->setSenderId($prvMessageSenderId);
    $newPrivateMessage->setReceiverId($prvMessageRecipientId);
    $newPrivateMessage->setText($newPrvMessageText);
    $newPrivateMessage->setReadStatus(0);
    $newPrivateMessage->saveToDB($conn);

//    $jsonPostedNewPrvMessage = [];
//
//    foreach ($usersArray as $username) {
//        $jsonPostedNewPrvMessage[] = json_decode(json_encode($username), true);
//    }

    $response = ['success' => "Private message sent"];
//    echo(json_encode($response));

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $userId = $_SESSION['userId'];
    $rcvdPrvMsgsArray = Privatemessage::loadAllRcvdPrvMsgsByUserId($conn,isset($userId) ? $userId : null);
    $jsonRcvdPrvMsgs = [];

    if (!is_null($rcvdPrvMsgsArray)) {
        foreach ($rcvdPrvMsgsArray as $prvMsg) {
            $jsonRcvdPrvMsgs[] = json_decode(json_encode($prvMsg), true);
        }
    }

    $sentPrvMsgsArray = Privatemessage::loadAllPrivateMessagesBySenderId($conn, isset($userId) ? $userId : null);
    $jsonSentPrvMsgs = [];
    if (!is_null($sentPrvMsgsArray)) {
        foreach ($sentPrvMsgsArray as $prvMsg) {
            $jsonSentPrvMsgs[] = json_decode(json_encode($prvMsg), true);
        }
    }

    $registeredUsers = [];
    $usersArray = Privatemessage::searchByUsername($conn);
    if (!is_null($usersArray)) {
        foreach ($usersArray as $username) {
            $registeredUsers[] = json_decode(json_encode($username), true);
        }
    }

//    $response = ['success' => $jsonUsernameQuery];
//    $response = $jsonUsernameQuery;
//    echo(json_encode($response));

    $response = ['success' => $jsonRcvdPrvMsgs,
        'sentPrvMsgs' => $jsonSentPrvMsgs,
        'users' => $registeredUsers];

}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    $userId = $_SESSION['userId'];
    parse_str(file_get_contents("php://input"), $patchVars);
    $privateMessage = Privatemessage::loadPrivateMessageById($conn, $patchVars['prvMsgId']);

    $privateMessage->setReadStatus($patchVars['readStatus']);
    $privateMessage->saveToDB($conn);

    $response = ['success' => $privateMessage];
}