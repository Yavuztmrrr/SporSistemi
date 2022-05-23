<?php
$id=$_GET["id"];
$idcozum = base64_decode($id);
$calismaprogramitarih = $_GET['tarih'];
$calismaprogramitarihcozumu = base64_decode($calismaprogramitarih);
$onlinekocId = $_GET['okid'];
$onlinekocIdcozum = base64_decode($onlinekocId);
include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "update tbl_calismaprogrami set OgrenciTamamlamaDurum = 'Tamamlandi', KayıtTarih='$calismaprogramitarihcozumu' where Id=".$idcozum);
if($sonuc>0){
    echo "güncellendi";
    header('Location: ./calismaprogramilisteleme.php?tarih=' . base64_encode($calismaprogramitarihcozumu)  . '&okid=' . base64_encode ($onlinekocIdcozum)  . '');
    
}
else{
    echo "güncellenmedi";
}


?>