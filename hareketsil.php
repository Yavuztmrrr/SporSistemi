<?php
$silinicekid=$_GET["id"];

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "delete from tbl_hareketisimleri where Id =$silinicekid ");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./hareketekle.php');
}
else{
    echo "Silinemedi";
}


?>