<?php
$calismaid=$_GET["id"];
$ogrenciId =  $_GET['Oid'];
$girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
$OgrenciIdcozum = base64_decode($ogrenciId);

include './dbconnect.php';

$sonuc=mysqli_query($mysqli ,"Delete from tbl_calismaprogrami where Id = $calismaid");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./calismaekle.php?Oid=' . base64_encode($OgrenciIdcozum)  . '&Okid=' . base64_encode ($girisYapanId)  . '');
}
else{
    echo "Silinemedi";
}


?>