<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Dilek Ve Şikayet</title>
</head>
<body style="background-color:powderblue;">
<?php
    include './dbconnect.php';
?>
<?php
    
?>
<?php
    include './parcali/menu.php';
?>
<?php
 if (isset($_POST["gonder"])) {
    if (strlen($_POST['adi']) != 0 && strlen($_POST['soyadi']) != 0 && strlen($_POST['konu']) != 0 && strlen($_POST['Message']) != 0) {
        
        $dilekvesikayet = $mysqli->query("INSERT INTO tbl_dilekce(Adi, Soyadi, Konusu, Icerik) VALUES ('" . $_POST["adi"]  . "','" . $_POST["soyadi"]  . "','" . $_POST["konu"]  . "','" . $_POST["Message"]  . "')" );
        if($dilekvesikayet){
            echo '<script> swal({
                title: "Dilek veya şikayetiniz alınmıştır!",
                button: "Tamam",
              }); </script>';
        }
        else{
            echo '<script> swal({
                title: "Yanlışlık oldu!",
                button: "Tamam",
              }); </script>';
        }
      
    }
    else {
        echo '<script> swal({
            title: "Bütün alanları doldurunuz!",
            button: "Tamam",
          }); </script>';
      
    }
}
?>
    <div style="height: 700px;" class="mesajContent" >
        <p class="mesajBaslik">Dilek ve Şikayet Sayfası</p>
        <div class="mesajIcerik">
        <form action="" method="POST">
                <label class="mesajLabel">Adınız</label>
                <input class="mesajInput" type="text" name="adi" />
                <label class="mesajLabel">Soyadınız</label>
                <input class="mesajInput" type="text" name="soyadi" />
                <label class="mesajLabel">Dilek ve Şikayet Konusu</label>
                <input class="mesajInput" type="text" name="konu" />
                <label  class="mesajLabel">Dilek ve Şikayet Mesajınız</label>
                <br>
                <textarea id="message" name="Message" rows="10" maxlength="255" ></textarea>
                <button style=" background-color: #800000;" type="submit"  name="gonder" class="mesajGonder">Gönder</button>
        </form>
        </div>
       
    
    </div>

<?php
    include './parcali/footer.php';
?>
</body>
</html>