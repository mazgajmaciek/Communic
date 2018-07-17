<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Communic</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<br>
<br>
<br>
<br>
<br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/tweetDetails.js"></script>

<?php
include_once '../../bootstrap.php';

$userId = $_SESSION['userId'];
?>

        <h3>Otrzymane wiadomości:</h3>

        <?php
        if ($userId == true) {

            $receivedMessages = PrivateMessage::loadAllPrivateMessagesByUserId($connection, $userId);

        } else {
            echo "Uzytkownik niezalogowany";
        }



//var_dump($receivedMessages);

        if ($receivedMessages !== null) {
            foreach ($receivedMessages as $key => $value) {
                if ($value->getReadStatus() == 0) {
                    if (strlen($value->getText()) > 30) {
                        $substring = substr($value->getText(), 0, 30);
                        echo "Autor wiadomości: " . $value->getUsername;
                        echo "Treść wiadomości: " . sprintf("<b><a id=\"privateMsgLink\" href=../privateMessageDetails.php?privatemessageid=%d > %s... </ida></b><br>", $value->getId(), $substring);

                        echo '<br>';
                    } else {
                        $substring = substr($value->getText(), 0, 30);
                        echo "Autor wiadomości: " . $value->getUsername;
                        echo "Treść wiadomości: " . sprintf("<b><a id=\"privateMsgLink\" href=../privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
                        echo '<br>';
                    }
                } else {

                    if (strlen($value->getText()) > 30) {
                        $substring = substr($value->getText(), 0, 30);
                        echo "Autor wiadomości: " . $value->getUsername . '<br>';
                        echo "Treść wiadomości: " . sprintf("<a id=\"privateMsgLink\" href=../privateMessageDetails.php?privatemessageid=%d> %s... </a><br>", $value->getId(), $substring);
                        echo '<br>';
                    } else {
                        $substring = substr($value->getText(), 0, 30);
                        echo "Autor wiadomości: " . $value->getUsername . '<br>';
                        echo "Treść wiadomości: " . sprintf("<a id=\"privateMsgLink\" href=../privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
                        echo '<br>';
                    }
                }
            }
        } else {
            echo "Brak otrzymanych wiadomości";

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
                echo "Treść wiadomości: " . sprintf("<b><a href=../privateMessageDetails.php?privatemessageid=%d> %s... </a></b><br>", $value->getId(), $substring);
                echo '<br>';
            } else {
                $substring = substr($value->getText(), 0, 30);
                //echo "Autor wiadomości: " . $value->getUsername;
                echo "Treść wiadomości: " . sprintf("<b><a href=../privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
                echo '<br>';
            }
        } else {

            if (strlen($value->getText()) > 30) {
                $substring = substr($value->getText(), 0, 30);
                //echo "Autor wiadomości: " . $value->getUsername . '<br>';
                echo "Treść wiadomości: " . sprintf("<a href=../privateMessageDetails.php?privatemessageid=%d> %s... </a><br>", $value->getId(), $substring);
                echo '<br>';
            } else {
                $substring = substr($value->getText(), 0, 30);
                //echo "Autor wiadomości: " . $value->getUsername . '<br>';
                echo "Treść wiadomości: " . sprintf("<a href=../privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
                echo '<br>';
            }
        }
    }
} else {
    echo "Brak wysłanych wiadomości";
}
?>