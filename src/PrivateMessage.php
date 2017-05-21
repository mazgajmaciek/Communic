<?php

class PrivateMessage {

    private $id;
    private $senderId;
    private $receiverId;
    private $creationDate;
    private $text;
    private $readStatus;

    public function __construct() {
        $this->id = -1;
        $this->senderId = null;
        $this->receiverId = null;
        $this->creationDate = null;
        $this->text = null;
        $this->readStatus = 0;
    }

    function getId() {
        return $this->id;
    }

    function getSenderId() {
        return $this->senderId;
    }

    function getReceiverId() {
        return $this->receiverId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

    function getReadStatus() {
        return $this->readStatus;
    }

//    function setId($id) {
//        $this->id = $id;
//    }

    function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setReadStatus($readStatus) {
        $this->readStatus = $readStatus;
    }

    static public function loadPrivateMessageById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM PrivateMessage WHERE id=:id");
        $result = $stmt->execute([
            'id' => $id
        ]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedPrivateMessage = new PrivateMessage();
            $loadedPrivateMessage->id = $row['id'];
            $loadedPrivateMessage->senderId = $row['sender_id'];
            $loadedPrivateMessage->receiverId = $row['receiver_id'];
            $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
            $loadedPrivateMessage->text = $row['privatemessage_text'];
            $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];

            return $loadedPrivateMessage;
        }

        return null;
    }

    static public function loadAllPrivateMessagesByUserId(PDO $pdo, $receiverId) {
        $stmt = $pdo->prepare("SELECT * FROM PrivateMessage WHERE receiver_id=:receiver_id");
        $result = $stmt->execute([
            'receiver_id' => $receiverId
        ]);

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedPrivateMessage = new PrivateMessage();
                $loadedPrivateMessage->id = $row['id'];
                $loadedPrivateMessage->senderId = $row['sender_id'];
                $loadedPrivateMessage->receiverId = $row['receiver_id'];
                $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
                $loadedPrivateMessage->text = $row['privatemessage_text'];
                $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];

                $ret[] = $loadedPrivateMessage;
            }
            return $ret;
        }
        return null;
    }
    
    static public function loadAllPrivateMessagesBySenderId(PDO $pdo, $senderId) {
        $stmt = $pdo->prepare("SELECT * FROM PrivateMessage WHERE sender_id=:sender_id");
        $result = $stmt->execute([
            'sender_id' => $senderId
        ]);

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedPrivateMessage = new PrivateMessage();
                $loadedPrivateMessage->id = $row['id'];
                $loadedPrivateMessage->senderId = $row['sender_id'];
                $loadedPrivateMessage->receiverId = $row['receiver_id'];
                $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
                $loadedPrivateMessage->text = $row['privatemessage_text'];
                $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];

                $ret[] = $loadedPrivateMessage;
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
            $sql = "INSERT INTO `PrivateMessage`(`sender_id`, `receiver_id`, `privatemessage_text`, `privatemessage_readstatus`) VALUES (:sender_id, :receiver_id, :privatemessage_text, :privatemessage_readstatus)";
            $prepare = $pdo->prepare($sql);

            //wyslanie zapytania do bazy z kluczami i wartosciami do podmienienia
            $result = $prepare->execute([
                //uzywa userId zapisanego w sesji
                'sender_id' => $this->senderId,
                'receiver_id' => $this->receiverId,
                'privatemessage_text' => $this->text,
                'privatemessage_readstatus' => $this->readStatus
            ]);

            // pobranie ostatniego ID dodanego rekordu i przypisanie do ID w tabeli Users
            //$this->id = $pdo->lastInsertId();

            return (bool) $result;
        } else {
            $sql = "UPDATE `PrivateMessage` SET `sender_id` = :sender_id, `receiver_id` = :receiver_id, `privatemessage_text` = :privatemessage_text, `privatemessage_readstatus` = :privatemessage_readstatus WHERE `id` = :id";

            $prepare = $pdo->prepare($sql);

            //wyslanie zapytania do bazy z kluczami i wartosciami do podmienienia
            $result = $prepare->execute([
                //uzywa userId zapisanego w sesji
                'sender_id' => $this->senderId,
                'receiver_id' => $this->receiverId,
                'privatemessage_text' => $this->text,
                'privatemessage_readstatus' => $this->readStatus,
                'id' => $this->id
            ]);

            // pobranie ostatniego ID dodanego rekordu i przypisanie do ID w tabeli Users
            //$this->id = $pdo->lastInsertId();

            if ($result === true) {
                return true;
            } else {
                echo "false";
            }
        }
    }

}
