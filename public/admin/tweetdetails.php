<?php
include_once '../bootstrap.php';
?>

<a href="mainpage.php"><h2>Powrót do strony głównej</h2> </a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    var_dump($_GET);
    echo "Szczegoly tweeta o id: " . $_GET['messageId'];
}
?>

<h3>Tweet details:</h3>

<?php
//var_dump($_SESSION);

$messageId = $_GET['messageId'];

$tweets = [];

$tweets = Tweet::loadAllTweets($connection);


//var_dump($tweets);


foreach ($tweets as $key => $value) {
    if ($value->getId() == $messageId) {
        echo $value->getId() . '<br>';
        echo $value->getCreationDate() . ' <br>';
        echo $value->getText() . '<br>';
        echo $value->getUserId() . '<br>';
    }
}