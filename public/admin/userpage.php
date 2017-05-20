<?php
include_once '../bootstrap.php';
?>



<a href="mainpage.php"><h2>Powrót do strony głównej</h2> </a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //var_dump($_GET);
    echo "Strona użytkownika " . $_GET['userId'];
}

if ($_SESSION['userId'] == $_GET['userId']) {
    echo sprintf("<a href=privateMessages.php><h3>Przejdź do prywatnych wiadomości</h3></a>"); 
}

?>

<h3>Wiadomosci wraz z komentarzami:</h3>

<?php
//var_dump($_SESSION);

$userId = $_GET['userId'];


$sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id WHERE `user_id`=:userId ORDER BY Messages.message_datetime DESC";

$stmt = $connection->prepare($sql);
$stmt->execute([
    'userId' => $userId,
        ]);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['username'] . '<br>';
        echo $row['message_text'] . '<br>';
        echo $row['message_datetime'] . '<br>';
        
        echo '<br>';
        
        //var_dump($row);
        //http://stackoverflow.com/questions/12151970/database-design-for-posts-and-comments
        
    }
} else {
    echo "Uzytkownik nie ma zadnych wiadomosci";
    
}
?>