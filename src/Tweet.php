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

    function setUserId($userId) {
        $this->userId = $userId;
    }

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

    static public function loadAllTweets(PDO $pdo) {



//        $stmt = $pdo->prepare("SELECT "
//                . "Users.username, "
//                . "Messages.message_text, "
//                . "Messages.message_datetime "
//                . "FROM "
//                . "Messages "
//                . "JOIN "
//                . "Users "
//                . "ON Users.id=Messages.user_id "
//                . "ORDER BY Messages.message_datetime DESC");
        $sql = "SELECT * FROM Messages JOIN Users ON Users.id=Messages.user_id ORDER BY Messages.message_datetime DESC";
        $ret = [];

        $result = $pdo->query($sql);

        if ($result !== false && $result->rowCount() > 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['message_id'];
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['message_text'];
                $loadedTweet->creationDate = $row['message_datetime'];

                $ret[] = $loadedTweet;
            }
            return $ret;
        }
        return null;
    }

    public function saveToDB(PDO $pdo) {
        //sprawdza czy robimy insert czy update
        if ($this->id == -1) { // if -1, robimy insert
            //przygotowanie zapytania
            //$userId = $_SESSION['userId'];
            $sql = "INSERT INTO `Messages`(`user_id`, `message_text`) VALUES (:user_id, :message_text)";
            $prepare = $pdo->prepare($sql);

            //wyslanie zapytania do bazy z kluczami i wartosciami do podmienienia
            $result = $prepare->execute([
                //uzywa userId zapisanego w sesji
                'user_id' => $this->userId,
                'message_text' => $this->text
            ]);

            // pobranie ostatniego ID dodanego rekordu i przypisanie do ID w tabeli Users
            //$this->id = $pdo->lastInsertId();


            return (bool) $result;
        }

        //edycja Tweeta
//        else {
//            //die("Zapis do bazy danych sie nie udal." . $pdo->errorInfo());
//            $sql = "UPDATE Users SET username=:username, email=:email, hash_password = :hash_password WHERE id=:id";
//            $stmt = $pdo->prepare($sql);
//            $result = $stmt->execute([
//                'username' => $this->username,
//                'email' => $this->email,
//                'hash_password' => $this->hashPassword,
//                'id' => $this->id
//            ]);
//
//            if ($result === true) {
//                return true;
//            }
//        }
    }

}
