<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Sifre Gonder Sayfası</title>
</head>
<body>  
    <?php
         include './sifregonder.php';
         include './dbconnect.php';
        ?>
    <?php 
   
    $satir = null;
    $satir2 = null;
    $onlinekocvarmi=null;
    $ogrencivarmi=null;
      if (count($_POST) > 0) {
        if (strlen($_POST['email']) != 0  ) {
              $onlinekocvarmi = $mysqli->query("SELECT * FROM tbl_onlinekoc WHERE Email='" . $_POST["email"]  . "' LIMIT 1 ");
              $ogrencivarmi = $mysqli->query("SELECT * FROM tbl_ogrenci WHERE Email='" . $_POST["email"]  . "' LIMIT 1 " );    
            
              $satir = $onlinekocvarmi->fetch_row();
              $satir2 = $ogrencivarmi->fetch_row();  
            
              if($satir>0 || $satir2>0){

                sifre($_POST['email']);
               
                // mail($_POST['email'],"",".");
                echo '<script> swal({
                  title: "Email ait kullanıcı vardır.Başarılı bir şekilde gönderilmiştir!",
                  type: "success",
                  button: "Tamam",
              }).then(function() {
                  location.replace("giris.php");
              }); </script>';  
              }
              else {
                echo '<script> swal({
                    title: "Emaile ait kullanıcı bulunamamıstır..",
                    button: "Tamam",
                  }); </script>'; 
              }
           
             
          }else{
            echo '<script> swal({
              title: "Boş alanları doldurunuz!",
              button: "Tamam",
            }); </script>';
          }
       }

    ?>
     <div class="islemler">
        <form class="" method="POST">
                <p class="islemBaslik">Şifre İşlemi</p>
                <hr>
                <input class="" type="text" name="email" placeholder="Email">
                <br>
                <br>
                <button class="aktivebuton" type="submit" >Gönder</button>
                <button class="aktivebuton"> <a class="kayitA" href="./giris.php">Giris</a></button>              
        </form>
    </div>
  
</body>
</html>