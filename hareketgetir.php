<?php
include './dbconnect.php';
$hareketid=$_POST["brans"];


$list = $db->query("select * from tbl_hareketisimleri where BransId ='".$hareketid ."'  ")->fetchAll(PDO :: FETCH_ASSOC);

foreach ($list as $key => $value) {
   echo '<option value = "'.$value['Id'].'" required> '.$value['Adi'].'</option>';
}

?>

