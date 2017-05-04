<?php
include_once '../bootstrap.php';
?>
<h1>Witaj, <?php echo $_SESSION['username']; ?></h1>

<h2>Dodaj nową wiadomość: </h2>
<form method="post" action="#">
    <?php //echo join('<br>', $errors); ?>
    <br>
    Twoja wiadomosc <input name="message_text" placeholder="Maksymalnie 140 znakow" maxlength="140">
    <br>
    <button type="submit">Wyslij</button>
    <br>
    <br>

    <?php
    $tweets = [];

    $tweets[] = Tweet::loadAllTweets($connection);

    foreach ($tweets as $key => $value) {
        echo $value;
    }




//    $sql = "SELECT Users.username, Messages.message_text, Messages.message_datetime FROM Messages JOIN Users ON Users.id=Messages.user_id ORDER BY Messages.message_datetime DESC";
//
//    $result = $connection->query($sql);
//
//    if ($result->rowCount() > 0) {
//        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//            echo $row['message_text'] . '<br>';
//            echo "<a href=userpage.php?username=" . $row['username'] . ">" . $row['username'] . '</a>' . '<br>';
//            echo $row['message_datetime'] . '<br>';
//            echo '<br>';
//        }
//    }
// below inserts new tweets into communic_db.Messages
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (!empty($_POST['message_text'])) {
            //var_dump($_SESSION);
            $messageText = $_POST['message_text'];

            $userId = $_SESSION['userId'];

            $sql = "INSERT INTO `Messages`(`user_id`, `message_text`) VALUES (:userid, :message_text)";

            try {
                $stmt = $connection->prepare($sql);
                $stmt->execute([
                    'userid' => $userId,
                    'message_text' => $messageText
                ]);
                echo "Wiadomosc została wysłana";
            } catch (Exception $ex) {
                
            }
        } else {
            echo "Nie wysłano wiadomości. Spróbuj ponownie";
        }
    } else {
        //echo "Nie wysłano wiadomości. Spróbuj ponownie";
    }
    ?>

