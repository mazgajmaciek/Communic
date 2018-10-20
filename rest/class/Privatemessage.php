<?php

class Privatemessage implements JsonSerializable {

    private $id;
    private $senderId;
    private $receiverId;
    private $creationDate;
    private $text;
    private $readStatus;
    private $userName;

    public static $pdo;

    public function __construct(PDO $pdo) {

        self::$pdo = $pdo;

        $this->id = -1;
        $this->senderId = null;
        $this->receiverId = null;
        $this->creationDate = null;
        $this->text = null;
        $this->readStatus = 0;
        $this->userName = null;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'senderId' => $this->senderId,
            'receiverId' => $this->receiverId,
            'creationDate' => $this->creationDate instanceof \DateTime ? $this->creationDate->format('Y-m-d H:i:s') : $this->creationDate,
            'text' => $this->text,
            'readStatus' => $this->readStatus,
            'userName' => $this->userName
        ];
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
        $stmt = $pdo->prepare("SELECT * FROM Users JOIN PrivateMessage ON Users.id=PrivateMessage.receiver_id WHERE PrivateMessage.id=:id");
        $result = $stmt->execute([
            'id' => $id
        ]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedPrivateMessage = new Privatemessage($pdo);
            $loadedPrivateMessage->id = $row['id'];
            $loadedPrivateMessage->senderId = $row['sender_id'];
            $loadedPrivateMessage->receiverId = $row['receiver_id'];
            $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
            $loadedPrivateMessage->text = $row['privatemessage_text'];
            $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];
            $loadedPrivateMessage->userName = $row['username'];
            

            return $loadedPrivateMessage;
        }

        return null;
    }

    static public function loadAllRcvdPrvMsgsByUserId(PDO $pdo, $receiverId = null) {
        $stmt = $pdo->prepare("SELECT p.*, u.username FROM PrivateMessage p JOIN Users u ON p.sender_id=u.id WHERE receiver_id=:receiver_id");
        $result = $stmt->execute([
            'receiver_id' => $receiverId
        ]);

        $rcvdPrvMsgsArray = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetchAll(PDO::FETCH_OBJ)) {

                foreach ($row as $dbPrvMessage) {
                    $loadedPrvMsg = new Privatemessage($pdo);
                    $loadedPrvMsg->id = $dbPrvMessage->id;
                    $loadedPrvMsg->senderId = $dbPrvMessage->sender_id;
                    $loadedPrvMsg->receiverId = $dbPrvMessage->receiver_id;
                    $loadedPrvMsg->creationDate = $dbPrvMessage->privatemessage_datetime;
                    $loadedPrvMsg->text = $dbPrvMessage->privatemessage_text;
                    $loadedPrvMsg->readStatus = $dbPrvMessage->privatemessage_readstatus;
                    $loadedPrvMsg->userName = $dbPrvMessage->username;

                    $rcvdPrvMsgsArray[] = $loadedPrvMsg;
                }
            }
            return $rcvdPrvMsgsArray;
        }
        return null;
    }
    
    static public function loadAllPrivateMessagesBySenderId(PDO $pdo, $senderId = null) {
//        $stmt = $pdo->prepare("SELECT * FROM PrivateMessage WHERE sender_id=:sender_id");
        $stmt = $pdo->prepare("SELECT p.*, u.username FROM PrivateMessage p JOIN Users u ON p.receiver_id=u.id WHERE sender_id=:sender_id");
        $result = $stmt->execute([
            'sender_id' => $senderId
        ]);

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedPrivateMessage = new Privatemessage($pdo);
                $loadedPrivateMessage->id = $row['id'];
                $loadedPrivateMessage->senderId = $row['sender_id'];
                $loadedPrivateMessage->receiverId = $row['receiver_id'];
                $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
                $loadedPrivateMessage->text = $row['privatemessage_text'];
                $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];
                $loadedPrivateMessage->userName = $row['username'];

                $ret[] = $loadedPrivateMessage;
            }
            return $ret;
        }
        return null;
    }

    static public function searchByUsername(PDO $pdo) {
        $stmt = $pdo->prepare("SELECT u.id, u.username FROM Users u");
        $result = $stmt->execute();

        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $loadedUsername = new Privatemessage($pdo);
                $loadedUsername->id = $row['id'];
                $loadedUsername->userName = $row['username'];

                $ret[] = $loadedUsername;
            }
            return $ret;
        }
        return null;
    }

//    static public function searchByUsername(PDO $pdo, $userName) {
//        $stmt = $pdo->prepare("SELECT u.id, u.username FROM Users u WHERE username LIKE CONCAT(:username,'%')");
//        $result = $stmt->execute([
//            'username' => $userName
//        ]);
//
//        $ret = [];
//
//        if ($result === true && $stmt->rowCount() > 0) {
//            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//
//                $loadedUsername = new Privatemessage($pdo);
//                $loadedUsername->id = $row['id'];
//                $loadedUsername->userName = $row['username'];
////                $loadedPrivateMessage->senderId = $row['sender_id'];
////                $loadedPrivateMessage->receiverId = $row['receiver_id'];
////                $loadedPrivateMessage->creationDate = $row['privatemessage_datetime'];
////                $loadedPrivateMessage->text = $row['privatemessage_text'];
////                $loadedPrivateMessage->readStatus = $row['privatemessage_readstatus'];
////                $loadedPrivateMessage->userName = $row['username'];
//
//                $ret[] = $loadedUsername;
//            }
//            return $ret;
//        }
//        return null;
//    }

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
