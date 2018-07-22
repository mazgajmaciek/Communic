<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $privateMessageId = $_GET['privatemessageid'];

    $privateMessage = Privatemessage::loadPrivateMessageById($conn, $privateMessageId);

    echo "Wysłane do: " . $privateMessage->getUsername . '<br>';
//    echo $privateMessage->getSenderId() . '<br>';
//    echo $privateMessage->getReceiverId() . '<br>';
    echo "Treść wiadomości: " . $privateMessage->getText() . '<br>';
    $privateMessage->setReadStatus(1);

    $privateMessage->saveToDB($conn);
};

?>