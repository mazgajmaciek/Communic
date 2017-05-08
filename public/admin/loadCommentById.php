<?php

include_once '../bootstrap.php';

var_dump(Comment::loadCommentById($connection, 3));
