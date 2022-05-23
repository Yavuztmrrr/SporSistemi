<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Giriş Yap</title>
</head>
<body>  
    <?php
    session_start();
    if (isset($_SESSION["sporsistemi"])) {
        header('Location: ./profil.php');
    }
    ?>
    <?php
    include './islem.php';
    $sonucOgrenci = null;
    $sonucOnlineKoc = null;
    $mailvarmi=null;
    $sifredegismeogrenci=null;
    $sifredegismeOnlineKoc=null;
    if (isset($_POST["email"])) {
        if (strlen($_POST['email']) != 0 && strlen($_POST['sifre']) != 0) {
          
    
            $sonucOgrenci =  execDb("SELECT Id , Email , AktivasyonKodu FROM tbl_ogrenci WHERE Email = '" . $_POST["email"]  . "' AND sifre = '"  . $_POST["sifre"] . "' AND Durum = true AND  SifreDegismeDurum = false");

            $sonucOnlineKoc =  execDb("SELECT Id , Email , AktivasyonKodu,BransId FROM tbl_OnlineKoc WHERE Email = '" . $_POST["email"]  . "' AND sifre = '"  . $_POST["sifre"] . "' AND Durum = true AND  SifreDegismeDurum = false");

            $sonucAdmin =  execDb("SELECT Id , Email  FROM tbl_admin WHERE Email = '" . $_POST["email"]  . "' AND sifre = '"  . $_POST["sifre"] . "' AND Durum = 'A' ");
            

            if($sonucOgrenci!=null && count($sonucOgrenci) > 0){

                $_SESSION["sporsistemi"] = $sonucOgrenci;
                header('Location: ./profil.php');
                //$sonucOnlineKoc =  execDb("SELECT Id ,Email,BransId , AktivasyonKodu FROM tbl_onlinekoc WHERE Email = '" . $_POST["email"]  . "' AND sifre = '"  . $_POST["sifre"] . "' AND Durum = true AND  SifreDegismeDurum = false");
            }
            else if ($sonucOnlineKoc != null && count($sonucOnlineKoc) > 0){
                $_SESSION["sporsistemi"] = $sonucOnlineKoc;
                header('Location: ./profil.php');
            }
            else if ($sonucAdmin != null && count($sonucAdmin) > 0){
                $_SESSION["sporsistemi"] = $sonucAdmin;
                header('Location: ./hareketekle.php');
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



     <div class="loginIcerik">
        <form action="" method="POST">
           <h1 class="kayitBaslik">Giris Yap</h1>
           <hr>
           <br>
            <label  class="loginLabel">Email</label>
            <input class="loginInput" type="email" name="email" placeholder="Email" />
            <label  class="loginLabel">Şifre</label>
            <input class="loginInput" type="password" name="sifre"  placeholder="Sifreniz" />
            <a class="sifremiunuttum" href="sifre.php">Sifremi Unuttum</a>
            <?php
                if ($sonucOgrenci !== null && count($sonucOgrenci) == 0 || $sonucOnlineKoc !== null && count($sonucOnlineKoc) == 0 ) {
                    
                    echo '<script> swal({
                        title: "Kullanıcı Adiniz veya Şifreniz Yanliştir!",
                        button: "Tamam",
                      }); </script>';
                }
                ?>

            <button type="submit" name="submit" class="kayitButon">Giriş Yap</button>
            <a class="kayitA kayitButon" style="margin-top:7px;line-height: 2.2;" href="./kayit.php"><p style="text-align: center;">KAYDOL</p></a>
        </form>
    </div>
    
    <?php
    include './parcali/footer.php';
    ?>
  
 
</body>
</html>