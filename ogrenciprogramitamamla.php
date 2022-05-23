<?php
$ogrenciId = $_GET['oid'];
$ogrenciIdcozum = base64_decode($ogrenciId);
$calismaprogramitarih = $_GET['tarih'];
$calismaprogramitarihcozumu = base64_decode($calismaprogramitarih);
$onlinekocId = $_GET['okid'];
$onlinekocIdcozum = base64_decode($onlinekocId);


print_r($calismaprogramitarihcozumu);

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "UPDATE tbl_calismaprogrami set ProgramDurumu = 'B' , KayıtTarih = '$calismaprogramitarihcozumu' where KayıtTarih = '$calismaprogramitarihcozumu' and OgrenciId =$ogrenciIdcozum and OnlineKocId = $onlinekocIdcozum  ");
if($sonuc>0){

    header('Location: ./egitim.php');
    
}
else{
    echo "Programı Bitiremediniz";
}


?>