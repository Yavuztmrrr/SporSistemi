

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
  <title>Şifre Değiştirme</title>


</head>
<body style="background-color:powderblue";>  



<?php
    include './parcali/menu.php';
    include './dbconnect.php';
    
?>

<?php
     $cod =  $_GET['coding'];

     $kullanıcıOgrenci = $db->query("select * from tbl_ogrenci where AktivasyonKodu ='".$cod."'  ")->fetch(PDO :: FETCH_ASSOC);
     $email = null;
     $sifre = null;

        if($kullanıcıOgrenci>0){ 
            $email = $kullanıcıOgrenci["Email"];
             $sifre = $kullanıcıOgrenci["Sifre"];

            if ($_POST) {
                if (strlen($_POST['yenisifre']) != 0 && strlen($_POST['yenisifretekrar']) != 0 ) {
                    $sifreIlk=$_POST['yenisifre'];
                    $sifreIkı=$_POST['yenisifretekrar']; 
                    if ($sifreIlk!=$sifreIkı){
                        echo '<script> swal({
                             title: "Şifreler uyuşmuyor",
                            button: "Tamam",
                           }); </script>';
                  }
                  else{
                    $guncellesıfreogrenci= $db->query(" UPDATE tbl_ogrenci SET SifreDegismeDurum='0' , Sifre = '" . $_POST["yenisifre"]  . "' WHERE  Email='" . $email ."' and Sifre = '" .  $sifre  . "' ");
                   
                    $kullanıcıOgrenciDetay = $db->query("select * from tbl_ogrenci where SifreDegismeDurum ='0' and Email ='" . $email ."'    ")->fetch(PDO :: FETCH_ASSOC);
                        
                    

                    if($kullanıcıOgrenciDetay != null && count($kullanıcıOgrenciDetay) > 0){
                        echo '<script> swal({
                            title: " Şifreniz Güncellenmiştir!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("giris.php");
                        }); </script>';  
                        
                    }
                   
                    else {
                        echo '<script> swal({
                            title: "Sorun Oluştu Tekrar Deneyın!",
                            button: "Tamam",
                          }); </script>';
                    }
        
                }
                  }
                    
                else {
                    echo '<script> swal({
                        title: "Bütün alanları doldurunuz!",
                        button: "Tamam",
                      }); </script>';
                  
                }
            }
            echo'
            <div class="mesajContent" >
            <p class="mesajBaslik">Şifre Değiştirme</p>
            <div class="mesajIcerik">
            <form action="" method="POST">
                    <label class="mesajLabel">Email</label>
                    <input class="mesajInput" type="text" value="  ' .$kullanıcıOgrenci['Email']. ' " name="Email" disabled />
                    <label class="mesajLabel">Eski Şifre</label>
                    <input class="mesajInput" type="text" value="   '.$kullanıcıOgrenci['Sifre']. '" name="eskisifre" disabled  />
                    <label  class="mesajLabel">Yeni Şifre</label>
                    <input class="mesajInput" type="password" pattern="[a-zA-Z0-9]*"  title="Türkçe ve özel karakter girmeyiniz."  minlength="8" id="p1" name="yenisifre" />
                    <label  class="mesajLabel">Yeni Şifre Tekrar</label>
                    <input class="mesajInput" type="password" name="yenisifretekrar"   />
                    <script type="text/javascript" src="icerik/script/sifretekrar.js"> </script>
                   <br>
                  
                    <button type="submit"  name="gonder" class="mesajGonder">Şifre Güncelle</button>
            </form>
            </div>
           
        </div>
    
            ';


                  
        }
        else{
            
            $kullanıcıOnlineKoc = $db->query("select * from tbl_onlinekoc where AktivasyonKodu ='".$cod."'  ")->fetch(PDO :: FETCH_ASSOC);
            $email = $kullanıcıOnlineKoc["Email"];
            $sifre = $kullanıcıOnlineKoc["Sifre"];
          

      
            if ($_POST) {
                if (strlen($_POST['yenisifre']) != 0 && strlen($_POST['yenisifretekrar']) != 0 ) {
                    $sifreIlk=$_POST['yenisifre'];
                    $sifreIkı=$_POST['yenisifretekrar']; 
                    if ($sifreIlk!=$sifreIkı){
                        echo '<script> swal({
                             title: "Şifreler uyuşmuyor",
                            button: "Tamam",
                           }); </script>';
                  }
                  else{
                    $guncellesıfreonlinekoc= $db->query(" UPDATE tbl_onlineKoc SET SifreDegismeDurum='0' , Sifre = '" . $_POST["yenisifre"]  . "' WHERE Email='" .  $email  . "' and Sifre = '" .  $sifre  . "' ");
                    
                    $kullanıcıOnlinekocDetay = $db->query("select * from tbl_onlineKoc where SifreDegismeDurum ='0' and Email ='" . $email ."'    ")->fetch(PDO :: FETCH_ASSOC);

                    if($kullanıcıOnlinekocDetay != null && count($kullanıcıOnlinekocDetay) > 0){
                        echo '<script> swal({
                            title: " Şifreniz Güncellenmiştir!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("giris.php");
                        }); </script>';  
                        
                    }
                   
                    else {
                        echo '<script> swal({
                            title: "Sorun Oluştu Tekrar Deneyın!",
                            button: "Tamam",
                          }); </script>';
                    }
        
                }
                  }
                    
                else {
                    echo '<script> swal({
                        title: "Bütün alanları doldurunuz!",
                        button: "Tamam",
                      }); </script>';
                  
                }
            }
            echo'
            <div class="mesajContent" >
            <p class="mesajBaslik">Şifre Değiştirme</p>
            <div class="mesajIcerik">
            <form action="" method="POST">
                    <label class="mesajLabel">Email</label>
                    <input class="mesajInput" type="text" value="  ' .$kullanıcıOnlineKoc['Email']. ' " name="Email" disabled />
                    <label class="mesajLabel">Eski Şifre</label>
                    <input class="mesajInput" type="text" value="   '.$kullanıcıOnlineKoc['Sifre']. '" name="eskisifre" disabled  />
                    <label  class="mesajLabel">Yeni Şifre</label>
                    <input class="mesajInput" type="password" pattern="[a-zA-Z0-9]*"  title="Türkçe ve özel karakter girmeyiniz."  minlength="8" id="p1" name="yenisifre" />
                    <label  class="mesajLabel">Yeni Şifre Tekrar</label>
                    <input class="mesajInput" type="password" name="yenisifretekrar"   />
                    <script type="text/javascript" src="icerik/script/sifretekrar.js"> </script>
                   <br>
                  
                    <button type="submit"  name="gonder" class="mesajGonder">Şifre Güncelle</button>
            </form>
            </div>
           
        </div>
    
            ';
      
      
        }
       
?>

<?php

    include './parcali/footer.php';
?>
</body>
</html>

