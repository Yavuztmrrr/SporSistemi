<?php
$silinicekid=$_GET["id"];

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "update tbl_mesajicerik set OnlineKocSil = 'A' where MesajId=".$silinicekid);
if($sonuc>0){
    echo "Silindi";
    header('Location: ./mesajliste.php');
}
else{
    echo "Silinemedi";
}


?>