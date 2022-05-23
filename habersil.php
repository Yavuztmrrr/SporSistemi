<?php
$silinicekid=$_GET["id"];

include './dbconnect.php';

$sonuc=mysqli_query($mysqli , "delete from tbl_onlinekochaber where Id =$silinicekid ");
if($sonuc>0){
    echo "Silindi";
    header('Location: ./haberekle.php');
}
else{
    echo "Silinemedi";
}


?>