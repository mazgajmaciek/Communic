<?php

include_once '../bootstrap.php';

$comment = new Comment();

var_dump($comment);



$comment->setUserId(6);
$comment->setPostId(35);
$comment->setText("komentarz1");

var_dump($comment);


$comment->saveToDB($connection);