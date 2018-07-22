<?php
include_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $privateMessageId = $_GET['privatemessageid'];

    $privateMessage = Privatemessage::loadPrivateMessageById($conn, $privateMessageId);

    $privateMessage->setReadStatus(1);
    $privateMessage->saveToDB($conn);
}