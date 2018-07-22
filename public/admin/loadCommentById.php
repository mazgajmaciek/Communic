<?php

include_once '../bootstrap.php';

var_dump(Comment::loadCommentById($conn, 3));