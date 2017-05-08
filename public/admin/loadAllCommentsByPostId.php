<?php

include_once '../bootstrap.php';

var_dump(Comment::loadAllCommentsByPostId($connection, 4));