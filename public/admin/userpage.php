<?php
include_once '../bootstrap.php';
?>



<a href="mainpage.php"><h2>Powrót do strony głównej
    </h2> </a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //var_dump($_GET);
    echo "Strona użytkownika " . $_GET['username'];
}
?>

<h3>Wiadomosci wraz z komentarzami:</h3>

<?php
//var_dump($_SESSION);

$userId = $_SESSION['userId'];


$sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id WHERE `user_id`= 6 ORDER BY Messages.message_datetime DESC";

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
        
    }
}
?>