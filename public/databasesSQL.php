<?php

//$users = 'CREATE TABLE `communic_db`.`Users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `email` VARCHAR(255) NOT NULL , `username` VARCHAR(255) NOT NULL , `hash_password` VARCHAR(60) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB;';
//$messages = 'CREATE TABLE `communic_db`.`Messages` ( `message_id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL , `message_text` VARCHAR(140) NOT NULL , `message_datetime` DATE NOT NULL , PRIMARY KEY (`message_id`)) ENGINE = InnoDB;';
//$comments = 'CREATE TABLE `communic_db`.`Comments` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `userId` INT(11) NOT NULL , `postId` INT(11) NOT NULL , `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `text` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
//$privateMessage = 'CREATE TABLE `communic_db`.`PrivateMessage` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `sender_id` INT(11) NOT NULL , `receiver_id` INT(11) NOT NULL , `privatemessage_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `privatemessage_text` TEXT NOT NULL , `privatemessage_readstatus` BIT NULL DEFAULT b'0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;';