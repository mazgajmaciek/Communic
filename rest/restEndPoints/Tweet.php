<?php
//TODO - json does not seem to be formatted correctly?

//include_once '../../public/bootstrap.php';
//include_once("Communic/public/connection.php");

header('Content-Type: application/json');//return json header

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//    $username = $_SESSION['username'];
    $tweets = Tweet::loadAllTweets($conn);
    $jsonTweets = [];


    foreach ($tweets as $newTweet) {
        $jsonTweets[] = json_decode(json_encode($newTweet), true);
    }

//    $response = ["tweets" => $jsonTweets,
//                "username" => $userName];

    $response = ["tweets" => $jsonTweets];

// below inserts new tweets into communic_db.Messages
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (!empty($_POST['new_message_text'])) {

        $messageText = $_POST['new_message_text'];
        //$userId = $_SESSION['userId'];

        $sql = "INSERT INTO `Messages`(`user_id`, `message_text`) VALUES (:userid, :message_text)";

        $newTweet = new Tweet($conn);
        $newTweet->setUserId($userId);
        $newTweet->setText($messageText);
        $newTweet->saveToDB($conn);

        $response += ["newTweet" => $newTweet];
    } else {
        $response += ["error" => "Cannot submit empty tweet."];
    }

} else {
    $response += ["error" => "Server error. New tweet not sent."];
}


//echo json_encode($response);

?>

