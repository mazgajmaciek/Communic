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



<div class="row voffset5">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

        <div class="panel panel-default">
            <div class="panel-body" id="username">
                Strona użytkownika
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Sent tweets</div>
            <div class="panel-body">
                <ul class="list-group" id="sentTweets">
                    <!--                    <li class="list-group-item">-->
                    <!--                        <div class="panel panel-default">-->
                    <!--                            <div class="panel-heading"><span class="authorTitle">Jan Kowalski</span>-->
                    <!--                                <button data-id="1" class="btn btn-danger pull-right btn-xs btn-author-remove"><i-->
                    <!--                                            class="fa fa-trash"></i></button>-->
                    <!--                                <button data-id="1" class="btn btn-primary pull-right btn-xs btn-author-books"><i-->
                    <!--                                            class="fa fa-book"></i></button>-->
                    <!--
                    <!--                            </div>-->
                    <!--                            <ul class="authorBooksList"></ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                </ul>
            </div>
        </div>

    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
</div>

<?php
//include_once '../../bootstrap.php';
//
////TODO below php code is supposed to be another endpoint
//
//
//
//if($_SESSION['userId'] == $_GET['userId']) {
//    echo sprintf("<a href=privateMessage.phpprivateMessage.php><h3>Przejdź do prywatnych wiadomości</h3></a>");
//}
//
//if ($_SESSION['userId'] !== $_GET['userId'])
//

//check if there is subpage request
//if (isset($_GET['action'])) {
//    var_dump($_GET['action']);
//
//    $addArr = explode('/', $_GET['action']);
//    var_dump($addArr);
//
//    if(($_SERVER['REQUEST_METHOD'] === 'GET') && ($_SESSION['userId'] === $addArr[1])) {
//
//        $tweets = Tweet::loadAllTweetsByUserId($conn, $userId);
//        $jsonSentTweets = [];
//
//        foreach ($tweets as $newTweet) {
//            $jsonSentTweets[] = json_decode(json_encode($newTweet), true);
//        }
//
//        $response = ['sentTweets' => $jsonSentTweets,
//            'username' => $userName];
//
//    } else {
//
//    }

//    $action = preg_replace('#[^0-9a-zA-Z]#', '', $addArr[0]);//clean all non alfanum chars from action for safety
//    $incFile = __DIR__.'/'.$action.'.php';//define variable with subpage path
//    include_once $incFile;//load subpage file


?>