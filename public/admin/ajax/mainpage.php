<?php
include_once '../../bootstrap.php';
header('Content-Type: application/json');//return json header

$username = $_SESSION['username'];
$tweets = Tweet::loadAllTweets($connection);
$jsonTweets = [];


foreach ($tweets as $newTweet) {
    $jsonTweets[] = json_decode(json_encode($newTweet), true);
}

$response = ["tweets" => $jsonTweets,
    "success" => $username];

// below inserts new tweets into communic_db.Messages

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $messageText = $_POST['new_message_text'];
    $userId = $_SESSION['userId'];

    $sql = "INSERT INTO `Messages`(`user_id`, `message_text`) VALUES (:userid, :message_text)";

    $newTweet = new Tweet();
    $newTweet->setUserId($userId);
    $newTweet->setText($messageText);
    $newTweet->saveToDB($connection);

    $response += ["newTweet" => $newTweet];
} else {
    $response += ["error" => "Server error. New tweet not sent."];
}

echo json_encode($response);

?>

