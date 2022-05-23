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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <title>Anasayfa</title>


</head>
<body style="background-color:powderblue";>  



<?php
    include './parcali/menu.php';
    include './dbconnect.php';
    include './islem.php';
?>

<?php
        $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
        $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
        
        if(isset($_POST['update']))
        {
        if(count($_POST)){
  
            $new_date = date('Y-m-d 00:00:00', strtotime($_POST['dateFrom']));
        
            echo '<script> swal({
                title: "Tarihi onayladınız! Çalışma güncelleye butonuna basabilirsiniz",
                button: "Tamam",
            }); </script>';
        
        }
        else{
            echo '<script> swal({
                title: "Tarihi Seciniz! ",
                button: "Tamam",
            }); </script>';
        }
    }

?>

  <div class="mesajContent" >
  <form name="DateFilter" method="POST">
        <p class="mesajBaslik">Çalışma Programı Güncelleştirme Tarihi Onayı </p>
        <div class="mesajIcerik">
        <input type="date" class="tarihcalisma" style="width: 98%; " name="dateFrom" value="<?php echo date('Y-m-d'); ?>" />
        <br>
        <button type="submit" style="width: 98%; ; " name="update" id="update" class="calismaBtn">Tarihi Onay Butonu</button>
        <br>
        <br>
        </form>
      
        <a href="calismaguncelle.php?ogrenciId=<?php  echo  base64_encode(48)?>&date=<?php  echo base64_encode($new_date);    ?>&onlinekocId= <?php  echo  base64_encode($girisYapanId)       ?> "style="width: 98%; float: right;  "  name="guncelle"  class="calismaBtnEkle" >  Çalışma Güncelle Formu </a>
        </div>
       
    
    </div>

    <a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>
</body>
</html>

