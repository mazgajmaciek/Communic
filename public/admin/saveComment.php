<?php

include_once '../bootstrap.php';

$comment = new Comment();

var_dump($comment);



$comment->setUserId(6);
$comment->setPostId(35);
$comment->setText("komentarz1");

var_dump($comment);


$comment->saveToDB($conn);

$comment2 = new Comment();

$comment2->setUserId(3);
$comment2->setPostId(4);
$comment2->setText('coment');

$comment2->saveToDB($conn);
