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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<title>Ogrenci Ekle</title>
</head>
<body style="background-color:powderblue;">  
<?php
   include './dbconnect.php';
   include './islem.php';
$OnlineKocId=$_GET["islemOk"];
$OnlineKocIdcozum = base64_decode($OnlineKocId);
$OgrenciId=$_GET["islemO"];
$OgrenciIdcozum = base64_decode($OgrenciId);
$email=$_GET["islemE"];
$emailcozum = base64_decode($email);



$egitimalanogrencivarmi =  execDb("select * from tbl_egitimalanogrenciler where OgrenciId=$OgrenciIdcozum and OnlineKocId=$OnlineKocIdcozum");
if($egitimalanogrencivarmi==null ){
    egitimalanogrencikayit($OgrenciIdcozum,$OnlineKocIdcozum,$emailcozum);
    echo '<script> swal({
        title: "İşleminiz Alınmıştır.Online Hocanız onaylarsa eğitim alıcaksınız.",
        type: "success",
        button: "Tamam",
    }).then(function() {
        location.replace("anasayfa.php");
    }); </script>';  
}
else{
    echo '<script> swal({
        title: "Kayıt Başarısızdır.Bir hocayı bir kere secebilirsiniz.",
        type: "success",
        button: "Tamam",
    }).then(function() {
        location.replace("anasayfa.php");
    }); </script>';  
}


?>
</body>
</html>
