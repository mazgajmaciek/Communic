<?php

include_once '../bootstrap.php';

Tweet::loadAllTweetsByUserId($connection, 6);

