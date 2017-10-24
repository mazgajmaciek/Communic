<?php

class Comment extends Tweet {

    private $id;
    private $userId;
    private $postId;
    private $creationDate;
    private $text;

    public function __construct() {
        $this->id = -1;
        $this->userId = null;
        $this->postId = null;
        $this->creationDate = null;
        $this->text = null;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getPostId() {
        return $this->postId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

//    function setId($id) {
//        $this->id = $id;
//    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setPostId($postId) {
        $this->postId = $postId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setText($text) {
        $this->text = $text;
    }

    static public function loadCommentById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM Comments WHERE id=:id");
        $result = $stmt->execute([
            'id' => $id
        ]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->postId = $row['postId'];
            $loadedComment->text = $row['text'];
            $loadedComment->creationDate = $row['creation_date'];

            return $loadedComment;
        }

        return null;
    }

    static public function loadAllCommentsByPostId(PDO $pdo, $postId) {
        $stmt = $pdo->prepare("SELECT * FROM `Comments` JOIN Users ON Users.id = Comments.userId WHERE postId=:postId ORDER BY creation_date DESC");
        $result = $stmt->execute([
            'postId' => $postId
        ]);

        //var_dump($stmt->rowCount());
        $ret = [];

        if ($result === true && $stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->postId = $row['postId'];
                $loadedComment->creationDate = $row['creation_date'];
                $loadedComment->text = $row['text'];
                $loadedComment->getUsername = $row['username'];

                $ret[] = $loadedComment;
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
            $sql = "INSERT INTO `Comments`(`userId`, `postId`, `text`) VALUES (:userId, :postId, :text)";
            $prepare = $pdo->prepare($sql);

            //wyslanie zapytania do bazy z kluczami i wartosciami do podmienienia
            $result = $prepare->execute([
                //uzywa userId zapisanego w sesji
                'userId' => $this->userId,
                'postId' => $this->postId,
                'text' => $this->text
            ]);

            // pobranie ostatniego ID dodanego rekordu i przypisanie do ID w tabeli Users
            //$this->id = $pdo->lastInsertId();


            return (bool) $result;
        }
    }

}
