<?php
include_once '../bootstrap.php';
?>



<a href="mainpage.php"><h2>Powrót do strony głównej
    </h2> </a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //var_dump($_GET);
    echo "Strona użytkownika " . $_GET['username'];
}

?>

<h3>Wiadomosci wraz z komentarzami:</h3>

<?php



?>