<?php
include_once '../bootstrap.php';

var_dump($_SESSION);

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
        echo sprintf("<b><a href=privateMessageDetails.php?privatemessageid=%d> %s </a></b><br>", $value->getId(), $substring);
    } else {
        $substring = substr($value->getText(), 0, 30);
        echo sprintf("<a href=privateMessageDetails.php?privatemessageid=%d> %s </a><br>", $value->getId(), $substring);
    }
}
   
