<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Communic - Userpage</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainpage.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
<!--page background-->
<div class="page-bg"></div>

<?php
//include_once '../../bootstrap.php';
//
////TODO below php code is supposed to be another endpoint
//var_dump($_GET);
//var_dump($_SESSION);
//
//
//
//if($_SESSION['userId'] == $_GET['userId']) {
//    echo sprintf("<a href=privateMessage.phpprivateMessage.php><h3>Przejdź do prywatnych wiadomości</h3></a>");
//}
//
//if ($_SESSION['userId'] !== $_GET['userId'])
//    ?>

    <h3>Wyślij prywatną wiadomość:</h3>

    <form method="post" action="#">
        Twoja wiadomosc <input name="private_message" placeholder="Max 140 znaków" maxlength="140">
        <br>
        <button type="submit">Wyslij</button>
        <br>
        <br>
    </form>

<!--    --><?php
//
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    if (isset($_POST['private_message']) && !empty($_POST['private_message'])) {
//
//        $privateMessageText = $_POST['private_message'];
//
//        $senderId = $_SESSION['userId'];
//        $receiverId = $_GET['userId'];
//
//        $privateMessage = new Privatemessage();
//
//        $privateMessage->setReadStatus(0);
//        $privateMessage->setReceiverId($receiverId);
//        $privateMessage->setSenderId($senderId);
//        $privateMessage->setText($privateMessageText);
//
//        $privateMessage->saveToDB($conn);
//
//        echo "Wiadomość wysłana!";
//    } else {
//        echo "Nie wpisano wiadomości";
//    }
//}
//?>


<h3>Wiadomości wraz z komentarzami:</h3>

<?php

?>