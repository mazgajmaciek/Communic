<?php
include_once '../bootstrap.php';

?>
<h1>Witaj, <?php echo $_SESSION['username']; ?></h1>

<a href="profileDetails.php"><h3>Twój profil</h3></a>

<a href="privateMessages.php"><h3>Przejdź do prywatnych wiadomości</h3></a>

<a href="logout.php"><h3>Wyloguj</h3></a>

<h2>Dodaj nową wiadomość: </h2>
<form method="post" action="#">
    <?php //echo join('<br>', $errors); ?>
    <br>
    Twoja wiadomosc <input name="message_text" placeholder="Maksymalnie 140 znakow" maxlength="140">
    <br>
    <button type="submit">Wyslij</button>
    <br>
    <br>

    <?php
    $tweets = [];

    $tweets = Tweet::loadAllTweets($connection);


    //var_dump($tweets);

    foreach ($tweets as $key => $value) {
        echo "Nazwa uzytkownika: " . "<b><a href=userpage.php?userId=" . $value->getUserId() . ">" . $value->getUsername . '</a></b>' . '<br>';
        echo "Id wiadomosci: " . "<a href=tweetdetails.php?messageId=" . $value->getId() . ">" . $value->getId() . '</a>' . '<br>';
        echo "Treść wiadomości: <i>" . $value->getText() . '</i><br>';
        echo $value->getCreationDate() . '<br>';
        $tweetComments = Comment::loadAllCommentsByPostId($connection, $value->getId());
        echo "Liczba komentarzy: " . "<a href=tweetdetails.php?messageId=" . $value->getId() . ">" . count($tweetComments) . '</a><br><br>';
    }




//    $sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id ORDER BY Messages.message_datetime DESC";
//
//    $result = $connection->query($sql);
//
//    if ($result->rowCount() > 0) {
//        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//            echo $row['message_text'] . '<br>';
//            echo "<a href=userpage.php?username=" . $value->getText() . ">" . $value->getText() . '</a>' . '<br>';
//            echo $row['message_datetime'] . '<br>';
//            echo '<br>';
//        }
//    }
//    
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

