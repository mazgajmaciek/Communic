<?php

include_once '../bootstrap.php';

var_dump(Comment::loadAllCommentsByPostId($conn, 35));