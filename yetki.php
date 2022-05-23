<?php
session_start();
    if(!isset($_SESSION["sporsistemi"])){
        header('Location: ./giris.php');
    }

?>