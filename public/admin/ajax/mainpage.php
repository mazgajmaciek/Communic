<?php
include_once '../../bootstrap.php';
header('Content-Type: application/json');//return json header

    $username = $_SESSION['username'];
    $tweets = Tweet::loadAllTweets($connection);
    $jsonTweets = [];


foreach ($tweets as $tweet) {
    $jsonTweets[] = json_decode(json_encode($tweet), true);
}

$response = ["tweets" => $jsonTweets,
            "success" => $username];

echo json_encode($response);

//    foreach ($tweets as $key => $value) {
//        echo "Nazwa uzytkownika: " . "<b><a href=userpage.php?userId=" . $value->getUserId() . ">" . $value->getUsername . '</a></b>' . '<br>';
//        echo "Id wiadomosci: " . "<a href=tweetdetails.php?messageId=" . $value->getId() . ">" . $value->getId() . '</a>' . '<br>';
//        echo "Treść wiadomości: <i>" . $value->getText() . '</i><br>';
//        echo $value->getCreationDate() . '<br>';
//        $tweetComments = Comment::loadAllCommentsByPostId($connection, $value->getId());
//        echo "Liczba komentarzy: " . "<a href=tweetdetails.php?messageId=" . $value->getId() . ">" . count($tweetComments) . '</a><br><br>';
//    }


// below inserts new tweets into communic_db.Messages
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (!empty($_POST['message_text'])) {
            //var_dump($_SESSION);

            $messageText = $_POST['message_text'];
            $userId = $_SESSION['userId'];

            $sql = "INSERT INTO `Messages`(`user_id`, `message_text`) VALUES (:userid, :message_text)";

            $tweet = new Tweet();
            $tweet->setUserId($userId);
            $tweet->setText($messageText);
            $tweet->saveToDB($connection);

            echo "Wiadomosc została wysłana";
        } else {
            echo "Nie wysłano wiadomości. Spróbuj ponownie";
        }
    } else {
        //echo "Nie wysłano wiadomości. Spróbuj ponownie";
    }
    ?>

