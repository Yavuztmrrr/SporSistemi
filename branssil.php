<?php
$silinicekid=$_GET["id"];

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "delete from tbl_brans where Id =$silinicekid ");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./bransekle.php');
}
else{
    echo "Silinemedi";
}


?>