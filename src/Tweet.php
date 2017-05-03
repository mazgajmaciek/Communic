<?php

class Tweet {

    private $id;
    private $userId;
    private $text;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->userId = null;
        $this->text = null;
        $this->creationDate = null;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

//    function setId($id) {
//        $this->id = $id;
//    }
//
//    function setUserId($userId) {
//        $this->userId = $userId;
//    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    static public function loadTweetById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM Messages WHERE message_id=:id");
        $result = $stmt->execute([
            'id' => $id
        ]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['message_id'];
            $loadedTweet->userId = $row['user_id'];
            $loadedTweet->text = $row['message_text'];
            $loadedTweet->creationDate = $row['message_datetime'];

            return $loadedTweet;
        }

        return null;
    }

    static public function loadAllTweetsByUserId(PDO $pdo, $id) {
        //$stmt = $pdo->prepare("SELECT * FROM Messages WHERE user_id=:id");
        $stmt = $pdo->prepare("SELECT "
                . "Users.username, "
                . "Messages.message_text, "
                . "Messages.message_datetime "
                . "FROM "
                . "Messages "
                . "JOIN "
                . "Users "
                . "ON Users.id=Messages.user_id "
                . "WHERE `user_id`=:id "
                . "ORDER BY Messages.message_datetime DESC");
        $result = $stmt->execute([
            'id' => $id
        ]);

        //var_dump($stmt->rowCount());


        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedTweet = new Tweet();
                //echo $loadedTweet->id = $row['message_id'] . '<br>';
                echo $loadedTweet->userId = $row['username'] . '<br>';
                echo $loadedTweet->text = $row['message_text'] . '<br>';
                echo $loadedTweet->creationDate = $row['message_datetime'] . '<br>';
                echo "<br>";


                //return $loadedTweet;
            }

            return null;
        }
    }

    static public function loadAllTweets($pdo) {
        $stmt = $pdo->prepare("SELECT "
                . "Users.username, "
                . "Messages.message_text, "
                . "Messages.message_datetime "
                . "FROM "
                . "Messages "
                . "JOIN "
                . "Users "
                . "ON Users.id=Messages.user_id "
                . "ORDER BY Messages.message_datetime DESC");
        $result = $stmt->execute();

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedTweet = new Tweet();
                //echo $loadedTweet->id = $row['message_id'] . '<br>';
                echo $loadedTweet->userId = $row['username'] . '<br>';
                echo $loadedTweet->text = $row['message_text'] . '<br>';
                echo $loadedTweet->creationDate = $row['message_datetime'] . '<br>';
                echo "<br>";


                //return $loadedTweet;
            }

            return null;
        }
    }

}
