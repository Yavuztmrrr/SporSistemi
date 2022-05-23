<?php
$silinicekId=$_GET["Id"];
$silinicekIdCozum=base64_decode($silinicekId);
$OnlineKocId =  $_GET['okid'];
$OnlineKocIdcozum = base64_decode($OnlineKocId);
$tarih =  $_GET['tarih'];
$tarihcozum = base64_decode($tarih);

include './dbconnect.php';

$sonuc=mysqli_query($mysqli ,"Delete from tbl_not where Id = $silinicekIdCozum");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./calismaprogramilisteleme.php?tarih=' . base64_encode($tarihcozum)  . '&okid=' . base64_encode ($OnlineKocIdcozum)  . '');
}
else{
    echo "Silinemedi";
}


?>