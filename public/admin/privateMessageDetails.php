<?php
include_once '../bootstrap.php';

var_dump($_GET);

echo ("<h3>")
?>
<h3>Twoja prywatna wiadomość:</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $privateMessageId = $_GET['privatemessageid'];

    $privateMessage = PrivateMessage::loadPrivateMessageById($connection, $privateMessageId);
    
    var_dump($privateMessage);
    

    echo $privateMessage->getSenderId() . '<br>';
    echo $privateMessage->getReceiverId() . '<br>';
    echo $privateMessage->getText() . '<br>';
    $privateMessage->setReadStatus(1);
    
    $privateMessage->saveToDB($connection);
    
    
    
    
}
//
?>
<h3><a href=privateMessages.php>Powrót do skrzynki odbiorczej</a></h3>