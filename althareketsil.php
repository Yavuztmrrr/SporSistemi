<?php
$silinicekid=$_GET["id"];

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "delete from tbl_althareketisimleri where Id =$silinicekid ");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./althareketekle.php');
}
else{
    echo "Silinemedi";
}


?>