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
    <title>Ogrenci Onayı Sayfası</title>
</head>
<body>  
    <?php 
    $egitimId=$_GET["islemEAO"];
    $egitimIdcozum = base64_decode($egitimId);



         include './islem.php';
         include './dbconnect.php';
                      
                  
                 
                $egitimalanogrencivarmi = $db->query("select * from tbl_egitimalanogrenciler where Id='" . $egitimIdcozum . "'")->fetch();
               

                if ($egitimalanogrencivarmi != null && count($egitimalanogrencivarmi) > 0 ) {
                    $aktifetOgrenci= execDb(" UPDATE tbl_egitimalanogrenciler SET Durum='I' WHERE Id='".$egitimalanogrencivarmi['Id']."'"); 

                    echo '<script> swal({
                        title: "Eğitimi iptal ettiniz.!",
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