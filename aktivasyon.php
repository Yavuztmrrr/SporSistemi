<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Aktivasyon Sayfası</title>
</head>
<body>  
    <?php 

        $date =  $_GET['date']; 
        $datecozum= base64_decode($date);
        print_r($datecozum);
         include './islem.php';
                        $sonucOgrenci = execDb("select * from tbl_ogrenci where Durum='0' and AktivasyonKodu='" . $_GET['key'] . "' ");
                        $sonucOnlineKoc=execDb("select * from tbl_onlinekoc where Durum='0' and AktivasyonKodu='" . $_GET['key'] . "' ");        
                    if ($sonucOgrenci != null && count($sonucOgrenci) > 0 || $sonucOnlineKoc != null && count($sonucOnlineKoc) > 0 ) {
                        $aktifetOgrenci= execDb(" UPDATE tbl_ogrenci SET Durum='1' WHERE AktivasyonKodu='" . $_GET['key'] . "'");
                        $aktifetOnlineKoc= execDb(" UPDATE tbl_onlineKoc SET Durum='1' WHERE AktivasyonKodu='" . $_GET['key'] . "'"); 
                        echo '<script> swal({
                            title: "Aktivasyon Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("giris.php");
                        }); </script>';  
                         
                    }
                    else{
                        echo '<script> swal({
                            title: "Aktivasyon başarısızdır. Daha onceden Aktif etmiş olabilir  veya aktivasyon kodu yanlıstır!",
                            button: "Tamam",
                          }); </script>';
                        

                    }
    
    ?>
 
  
</body>
</html>