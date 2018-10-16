<?php
session_start();

header('Content-Type: application/json');//return json header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../class/Privatemessage.php');

    //load DB config
    require_once '../config/db.php';

    //connect to DB
    try {
        $conn = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8"
            , DB_LOGIN, DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        $response = ['error' => 'DB Connection error: '.$e->getMessage()];
    }

    $query = $_POST["usernameQuery"];
    $jsonUsernameQuery = [];
    $queryResultArray = Privatemessage::searchByUsername($conn, $query);

    foreach ($queryResultArray as $username) {
        $jsonUsernameQuery[] = json_decode(json_encode($username), true);
    }

    $response = ['success' => $jsonUsernameQuery];
    echo json_encode($response);
}

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