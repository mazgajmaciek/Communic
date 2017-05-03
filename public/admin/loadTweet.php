<?php

include_once '../bootstrap.php';

var_dump(Tweet::loadAllTweetsByUserId($connection, 6));

