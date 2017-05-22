<?php
include_once '../bootstrap.php';

$userId = $_SESSION['userId'];
?>

<h3><a href=mainpage.php>Powrót do strony głównej</a><h3>

        <h3>Otrzymane wiadomości:</h3>

        <?php
        if ($userId == true) {
            $receivedMessages = [];
            $receivedMessages = PrivateMessage::loadAllPrivateMessagesByUserId($connection, $userId);
        } else {
            echo "Uzytkownik niezalogowany";
        }

//var_dump($receivedMessages);

        foreach ($receivedMessages as $key => $value) {

            if ($value->getReadStatus() == 0) {
                $substring = substr($value->getText(), 0, 30);
                echo "Autor wiadomości: " . $value->getSenderId();
                echo "Treść wiadomości: " . sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
            } else {
                $substring = substr($value->getText(), 0, 30);
                echo "Autor wiadomości: " . $value->getSenderId() . '<br>';
                echo "Treść wiadomości: " . sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
            }
        }
        ?>

        <h3>Wysłane wiadomości:</h3>

        <?php
        if ($userId == true) {
            $sentMessages = [];
            $sentMessages = PrivateMessage::loadAllPrivateMessagesBySenderId($connection, $userId);

            //var_dump($sentMessages);
        } else {
            echo "Uzytkownik niezalogowany";
        }

//var_dump($receivedMessages);
        if ($sentMessages !== null) {
            foreach ($sentMessages as $key => $value) {

                if ($value->getReadStatus() == 0) {
                    $substring = substr($value->getText(), 0, 30);
                    echo sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
                } else {
                    $substring = substr($value->getText(), 0, 30);
                    echo sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
                }
            }
        } else {
            echo "Brak wysłanych wiadomości";
            
        }
