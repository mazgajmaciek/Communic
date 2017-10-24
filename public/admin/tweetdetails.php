<?php
include_once '../bootstrap.php';
?>

<a href="mainpage.php"><h2>Powrót do strony głównej</h2> </a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "Szczegoly tweeta o id: " . $_GET['messageId'];
}
?>

<h3>Tweet details:</h3>

<?php

$messageId = $_GET['messageId'];

$tweets = [];

$tweets = Tweet::loadAllTweets($connection);

foreach ($tweets as $key => $value) {
    if ($value->getId() == $messageId) {
        //echo $value->getId() . '<br>';
        
        echo "Treść wiadomości: <b>" . $value->getText() . '</b><br>';
        echo "Data wysłania: " . $value->getCreationDate() . ' <br>';
        echo "Autor wiadomości: " . $value->getUsername . '<br>';
    }
}
?>

<h4>Tweet comments:</h4>

<?php
$tweetComments = Comment::loadAllCommentsByPostId($connection, $messageId);

if ($tweetComments != null) {
    foreach ($tweetComments as $key => $value) {
        if ($value->getPostId() == $messageId) {
//    echo "Data stworzenia: " . $value->getCreationDate() . '<br>';
//    echo "Id komentarza: " . $value->getId() . '<br>';
//    echo "Id tweeta: " . $value->getPostId() . '<br>';
            echo "Tekst komentarza: " . $value->getText() . '<br>';
            //echo "Id usera: " . $value->getUserId() . '<br>';
            echo "Autor komentarza: " . $value->getUsername . '<br>';
            echo "<br>";
        }
    }
} else {
    echo "Brak komentarzy do wyświetlenia.";
}
?>    
<form method="post">
    <br>
    Dodaj komentarz <input name="comment_text" placeholder="Maksymalnie 60 znakow" maxlength="60">
    <br>
    <button type="submit">Wyslij</button>
    <br>
    <br>
</form>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
//    var_dump($_POST);
//    var_dump($_SESSION);
    
    
    $text = $_POST['comment_text'];
    
    $comment = new Comment;
    
    $comment->setPostId($messageId);
    $comment->setText($text);
    $comment->setUserId($_SESSION['userId']);
    $comment->saveToDB($connection);
    
    
    
    echo "Dodano nowy komentarz";
    
}

?>
