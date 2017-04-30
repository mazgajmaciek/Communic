<?php
include_once '../bootstrap.php';
//SHOW * FROM Messages of all users, sorted by date when added

var_dump($_SESSION);

$sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id ORDER BY Messages.message_datetime DESC";



?>

<h2>Dodaj nową wiadomość: </h2>
        <form method="post">
            <?php echo join('<br>', $errors); ?>
            <br>
            Twoja wiadomosc <input name="message_text">
            <br>
            <button type="submit">Wyslij</button>