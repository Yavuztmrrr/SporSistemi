<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yst_sporsistemi";
        $mysqli =  new mysqli($servername, $username, $password, $dbname);

        if ($mysqli->connect_error) {
            die("hata:" . $mysqli->connect_error);
        }
?>
<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=yst_sporsistemi', 'root', '');
} catch (PDOException $e) {
    
    print $e->getMessage();
}
?>