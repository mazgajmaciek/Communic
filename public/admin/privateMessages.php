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

            //var_dump($receivedMessages);


            if ($value->getReadStatus() == 0) {


                if (strlen($value->getText()) > 30) {
                    $substring = substr($value->getText(), 0, 30);
                    echo "Autor wiadomości: " . $value->getUsername;
                    echo "Treść wiadomości: " . sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s... </a></b><br>", $value->getId(), $substring);
                    echo '<br>';
                } else {
                    $substring = substr($value->getText(), 0, 30);
                    echo "Autor wiadomości: " . $value->getUsername;
                    echo "Treść wiadomości: " . sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
                    echo '<br>';
                }
            } else {

                if (strlen($value->getText()) > 30) {
                    $substring = substr($value->getText(), 0, 30);
                    echo "Autor wiadomości: " . $value->getUsername . '<br>';
                    echo "Treść wiadomości: " . sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s... </a><br>", $value->getId(), $substring);
                    echo '<br>';
                } else {
                    $substring = substr($value->getText(), 0, 30);
                    echo "Autor wiadomości: " . $value->getUsername . '<br>';
                    echo "Treść wiadomości: " . sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
                    echo '<br>';
                }
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

//        if ($value->getReadStatus() == 0) {
//            $substring = substr($value->getText(), 0, 30);
//            echo sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
//        } else {
//            $substring = substr($value->getText(), 0, 30);
//            echo sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
//        }

                if ($value->getReadStatus() == 0) {


                    if (strlen($value->getText()) > 30) {
                        $substring = substr($value->getText(), 0, 30);
                        //echo "Autor wiadomości: " . $value->getUsername;
                        echo "Treść wiadomości: " . sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s... </a></b><br>", $value->getId(), $substring);
                        echo '<br>';
                    } else {
                        $substring = substr($value->getText(), 0, 30);
                        //echo "Autor wiadomości: " . $value->getUsername;
                        echo "Treść wiadomości: " . sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
                        echo '<br>';
                    }
                } else {

                    if (strlen($value->getText()) > 30) {
                        $substring = substr($value->getText(), 0, 30);
                        //echo "Autor wiadomości: " . $value->getUsername . '<br>';
                        echo "Treść wiadomości: " . sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s... </a><br>", $value->getId(), $substring);
                        echo '<br>';
                    } else {
                        $substring = substr($value->getText(), 0, 30);
                        //echo "Autor wiadomości: " . $value->getUsername . '<br>';
                        echo "Treść wiadomości: " . sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
                        echo '<br>';
                    }
                }
            }
        } else {
            echo "Brak wysłanych wiadomości";
        }
