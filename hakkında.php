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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Hakkında</title>


</head>
<?php
    include './parcali/menu.php';

?>
<body style="background-color:powderblue";>  

<div class="hahkkindaContent" >
        <p class="mesajBaslik">Hakkimizda</p>
        <div class="baslikHakında">
        <h3 class="hakkindabaslik" style="margin-top:80px">İstanbul Medipol Üniversitesi Bilgisayar Proğramcılığı Yönlendirilimiş Çalişma Dersi Proje Ödevidir.</h3>
        </div>
        <div class="icerikHakında">
        <p class="hakkindaIcerik">Projemde Spor branşlarıyla ilgili dalların üzerine online koçlar bulunup hizmet vermek amaçlanmıştır.</p>
        </div>
        
        <div style="float: right; margin-right:50px" class="footersag">
            <a href="https://www.instagram.com/yavuztmrr/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://twitter.com/?lang=tr" target="_blank"><i class="fa fa-twitter"></i></a>

            </div>
            <p class="hakkindaIcerik2">SporSistemi2021</p>
    </div>

       




   

<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>
<?php

    include './parcali/footer.php';
?>
</body>
</html>

