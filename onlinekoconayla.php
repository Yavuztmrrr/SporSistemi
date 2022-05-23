<?php
include './yetki.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Oögrenci Onayı Sayfası</title>
</head>
<body>  
    <?php 
    $OgrenciId=$_GET["islemO"];
    $OgrenciIdcozum = base64_decode($OgrenciId);
    $OnlineKocId=$_GET["islemOk"];
    $OnlineKocIdcozum = base64_decode($OnlineKocId);


         include './islem.php';
         include './dbconnect.php';
                      
                  
                 
                $egitimalanogrencivarmi = $db->query("select * from tbl_egitimalanogrenciler where OgrenciId='" . $OgrenciIdcozum . "' and OnlineKocId='" . $OnlineKocIdcozum . "'")->fetch();
                $onlinekoc = $db->query("select * from tbl_onlinekoc where  Id='" . $OnlineKocIdcozum . "'")->fetch();
                $ogrencimail = $db->query("select * from tbl_ogrenci where  Id='" . $OgrenciIdcozum . "'")->fetch();
                
                $brans= $db->query("select br.Adi as BransAdi from tbl_brans br inner join tbl_onlinekoc ol on br.Id=ol.BransId where ol.Id='".$onlinekoc['Id']."' ")->fetch();
               

                if ($egitimalanogrencivarmi != null && count($egitimalanogrencivarmi) > 0 ) {
                    $aktifetOgrenci= execDb(" UPDATE tbl_egitimalanogrenciler SET Durum='A' WHERE Id='".$egitimalanogrencivarmi['Id']."'"); 
                   
                    odemeformu($egitimalanogrencivarmi['Id'],$onlinekoc['EgitimFiyati'],$ogrencimail['Email'],$brans['BransAdi']);

                    echo '<script> swal({
                        title: "Ogrenciyi onayladınız eger Ogrenci ücreti öderse dersleriniz basliyacaktır.!",
                        type: "success",
                        button: "Tamam",
                    }).then(function() {
                        location.replace("anasayfa.php");
                    }); </script>';  
                     
                }
                else{
                    echo '<script> swal({
                        title: "Yanlislik oldu.!",
                        type: "success",
                        button: "Tamam",
                    }).then(function() {
                        location.replace("anasayfa.php");
                    }); </script>'; 
                    

                }
    ?>
 
  
</body>
</html>