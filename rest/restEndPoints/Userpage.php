<?php
session_start();

header('Content-Type: application/json');//return json header

if (($_SERVER['REQUEST_METHOD'] === 'GET') && ($_SESSION['userId'] === $_GET['user'])) {

    $userId = $_SESSION['userId'];

    $userName = $_SESSION['username'];
//    echo "Strona użytkownika " . $userName;

    //TODO - add logic for redirecting to logged user page (part for sending private message should NOT be visible)
    //TODO - add logic for json handler for sent tweets

    $tweets = Tweet::loadAllTweetsByUserId($conn, $userId);
    $jsonSentTweets = [];

    foreach ($tweets as $newTweet) {
        $jsonTweets[] = json_decode(json_encode($newTweet), true);
    }

    $response = ["sentTweets" => $jsonSentTweets];

    //TODO - the above should probably replace the below logic

    $sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime, Messages.message_id FROM Messages JOIN Users ON Users.id=Messages.user_id WHERE `user_id`=:userId ORDER BY Messages.message_datetime DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'userId' => $userId,
    ]);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messageId = $row['message_id'];

            //echo $row['message_id'] . '<br>';
            echo "Użytkownik: " . $row['username'] . '<br>';
            echo "Treść wiadomości: <b>" . $row['message_text'] . '</b><br>';
            echo "Wysłano: " . $row['message_datetime'] . '<br>';
            $tweetComments = Comment::loadAllCommentsByPostId($conn, $messageId);
            echo "Liczba komentarzy: " . "<a href=tweetdetails.php?messageId=" . $messageId . ">" . count($tweetComments) . '</a><br><br>';
            echo '<br>';

            //var_dump($row);
            //http://stackoverflow.com/questions/12151970/database-design-for-posts-and-comments
        }
    } else {
        echo "Uzytkownik nie ma zadnych wiadomosci";
    }

} else {

    //TODO - add logic for redirecting to page of another user (not currently logged)
    //TODO - add logic for json handler for sent tweets
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['private_message']) && !empty($_POST['private_message'])) {

        $privateMessageText = $_POST['private_message'];

        $senderId = $_SESSION['userId'];
        $receiverId = $_GET['userId'];

        $privateMessage = new Privatemessage($conn);

        $privateMessage->setReadStatus(0);
        $privateMessage->setReceiverId($receiverId);
        $privateMessage->setSenderId($senderId);
        $privateMessage->setText($privateMessageText);

        $privateMessage->saveToDB($conn);

        echo "Wiadomość wysłana!";
    } else {
        echo "Nie wpisano wiadomości";
    }
}