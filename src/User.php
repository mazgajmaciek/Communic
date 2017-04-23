<?php

class User {

    private $id;
    private $username;
    private $hashPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        // default null, nie trzeba wpisywac reszty
    }

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getHashPassword() {
        return $this->hashPassword;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setHashPassword($hashPassword) {
        $this->hashPassword = $hashPassword;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    public function save(PDO $pdo) {
        //sprawdza czy robimy insert czy update
        if ($this->id == -1) { // if -1, robimy insert
            //przygotowanie zapytania
            $sql = "INSERT INTO Users(username, email, hash_password) VALUES (:username, :email, :hash_password)";
            $prepare = $pdo->prepare($sql);

            //wyslanie zapytania do bazy z kluczami i wartosciami do podmienienia
            $result = $prepare->execute([
                'username' => $this->username,
                'email' => $this->email,
                'hash_password' => $this->hashPassword
            ]);

            // pobranie ostatniego ID dodanego rekordu
            $this->id = $pdo->lastInsertId();


            return (bool) $result;
        } else {
            //die("Zapis do bazy danych sie nie udal." . $pdo->errorInfo());
        }
    }

}
