
<h2>Dodaj nową wiadomość: </h2>
        <form method="post">
            <?php //echo join('<br>', $errors); ?>
            <br>
            Twoja wiadomosc <input name="message_text" placeholder="Maksymalnie 140 znakow" maxlength="140">
            <br>
            <button type="submit">Wyslij</button>

<?php
include_once '../bootstrap.php';
//SHOW * FROM Messages of all users, sorted by date when added

var_dump($_SESSION);

$sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id ORDER BY Messages.message_datetime DESC";

$result = $connection->query($sql);

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['message_text'] . '<br>';
            echo $row['username'] . '<br>';
            echo $row['message_datetime'] . '<br>';
            echo '<br>';
            
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['message_text'])) {
            
        }
    }

?>

