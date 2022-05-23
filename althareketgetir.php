<?php
include './dbconnect.php';
$hareketid=$_POST["hareket"];


$list = $db->query("select * from tbl_althareketisimleri where hareketId ='".$hareketid ."'  ")->fetchAll(PDO :: FETCH_ASSOC);

foreach ($list as $key => $value) {
   echo '<option value = "'.$value['Id'].'" required> '.$value['Adi'].'</option>';
}

?>

