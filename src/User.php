<?php

class User {

    private $id;
    private $username;
    private $hashPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        // default null (jesli zmienna nie jest podana
        // nie trzeba wpisywac reszty ponizej
//        $this->username = "";
//        $this->email = "";
//        $this->hashPass = "";
    }

    // nikt poza naszą klasą nie powinien zmieniać atrybutu id
//    function getId() {
//        return $this->id;
//    }

    function getUsername() {
        return $this->username;
    }

    function getHashPassword() {
        return $this->hashPassword;
    }

    function getEmail() {
        return $this->email;
    }

    // nikt poza naszą klasą nie powinien zmieniać atrybutu id
//    function setId($id) {
//        $this->id = $id;
//    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setHashPassword($hashPassword) {

        //hashowanie hasła
        $newHashedPassword = password_hash($hashPassword, PASSWORD_BCRYPT, [
            // manually added salt - deprecated in PHP7.0
            // 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            'cost' => 11
        ]);

        $this->hashPassword = $newHashedPassword;
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

            // pobranie ostatniego ID dodanego rekordu i przypisanie do ID w tabeli Users
            $this->id = $pdo->lastInsertId();


            return (bool) $result;
        } else {
            //die("Zapis do bazy danych sie nie udal." . $pdo->errorInfo());
            $sql = "UPDATE Users SET username=:username, email=:email, hash_password = :hash_password WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'hash_password' => $this->hashPassword,
                'id' => $this->id
            ]);
            
            if ($result === true) {
                return true;
            }
            
        }
    }

    static public function loadUserById(PDO $pdo, $id) {

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE id=:id");
        $result = $stmt->execute([
            'id' => $id
        ]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPassword = $row['hash_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }

        return null;
    }

    static public function showUserByEmail(PDO $connection, $email) {
        $stmt = $connection->prepare('SELECT * FROM Users WHERE email=:email');
        $result = $stmt->execute(['email' => $email]);

        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPassword = $row['hash_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }

        return null;
    }

    static public function loadAllUsers(PDO $pdo) {
        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $pdo->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashPassword = $row['hash_password'];
                $loadedUser->email = $row['email'];

                $ret[] = $loadedUser;
            }
        }

        return $ret;
    }

}
