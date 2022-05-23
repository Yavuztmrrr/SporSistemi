<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Kayıt ol</title>
</head>
<body>  
        <?php
        include './islem.php';
        include './dbconnect.php';
        ?>
<?php
        $satir = null;
        $satir2 = null;
        if(isset($_POST['btnKayitO'])) { 
            if (count($_POST) > 0) {
                if (strlen($_POST['oadi']) != 0 &&  strlen($_POST['osoyadi']) != 0 && strlen($_POST['oemail']) != 0 && strlen($_POST['osifre']) != 0 && strlen($_POST['osifretekrar']) != 0) {
                    $sonuc = $mysqli->query("SELECT * FROM tbl_ogrenci WHERE Email='" . $_POST["oemail"]  . "' LIMIT 1 " );
                    $onlinekocvarmi = $mysqli->query("SELECT * FROM tbl_onlinekoc WHERE Email='" . $_POST["oemail"]  . "' LIMIT 1 " );

                    $satir = $sonuc->fetch_row();
                    $satir2 = $onlinekocvarmi->fetch_row();

                    if($satir>0 || $satir2>0){
                        echo '<script> swal({
                            title: "Bu Kayıt Daha önceden eklenmiştir!",
                            button: "Tamam",
                          }); </script>';
                        
                    }
                    else{
                        oKayit($_POST['oadi'], $_POST['osoyadi'], $_POST['oemail'], $_POST['osifre']);
                        //mail($_POST['oemail'], "aktivasyon yapınız.", "linke tıklayınız.");
                        echo '<script> swal({
                            title: "Başarılı şekilde kayıt oldunuz. Mailinize gelen aktivasyon ile doğrulayınız",
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
            
        }
    ?>
   
    <?php
        $satir = null;
        $satir2 = null;
        if(isset($_POST['btnKayitOk'])) { 
            if (count($_POST) > 0) {
                if (strlen($_POST['okadi']) != 0  && strlen($_POST['oksoyadi']) != 0 && strlen($_POST['okemail']) != 0 && strlen($_POST['oksifre']) != 0 && strlen($_POST['oksifretekrar']) != 0&& strlen($_POST['okfiyat']) != 0 && strlen($_POST['okbransi']) != 0) {
                    $sonuc = $mysqli->query("SELECT * FROM tbl_onlinekoc WHERE Email='" . $_POST["okemail"]  . "' LIMIT 1 " );
                    $ogrencivarmi = $mysqli->query("SELECT * FROM tbl_ogrenci WHERE Email='" . $_POST["okemail"]  . "' LIMIT 1 " );

                    $satir = $sonuc->fetch_row();
                    $satir2 = $ogrencivarmi->fetch_row();

                    if($satir>0 || $satir2>0){
                        echo '<script> swal({
                            title: "Bu Kayıt Daha önceden eklenmiştir!",
                            button: "Tamam",
                          }); </script>';  
                    }
                    else{
                        okKayit($_POST['okadi'], $_POST['oksoyadi'], $_POST['okemail'], $_POST['oksifre'], $_POST['okfiyat'],$_POST['okbransi']);
                        //mail($_POST['okemail'], "aktivasyon yapınız.", "linke tıklayınız.");
                        echo '<script> swal({
                            title: "Başarılı şekilde kayıt oldunuz. Mailinize gelen aktivasyon ile doğrulayınız",
                            button: "Tamam",

                          }); </script>';
                  
                     
                       
                    }    
                } else {
                    echo '<script> swal({
                        title: "Bütün alanları doldurunuz!",
                        button: "Tamam",
                      }); </script>';
                  
                }
            }   
        } 
        
    ?>
    <?php
    $liste = "SELECT * FROM tbl_brans";
    $result = mysqli_query($mysqli, $liste);
    ?>
     <div class="baslangic">
        <input  type="submit" onclick="document.getElementById('id01').style.display='block'"  class="butonlar"  value='ONLİNE KOÇ'>
        <div id="id01"  class="modal">
            <div class="kayitIcerik">
            
                <form action="" method="POST">
                <span  class="kapat" >&times;</span>
                <script type="text/javascript" src="icerik/script/closemodal.js"> </script>
                    <h2 class="kayitBaslik">ONLİNE KOÇ KAYIT FORMU</h2>
                    <hr>
                    <br>
                    <label class="kayitLabel">Ad</label>
                    <input class="kayitInput" type="text" name="okadi" />
                    <label class="kayitLabel">Soyad</label>
                    <input class="kayitInput" type="text" name="oksoyadi" />
                    <label  class="kayitLabel">Email</label>
                    <input class="kayitInput" type="email" name="okemail"  />
                    <label  class="kayitLabel">Şifre</label>
                    <input class="kayitInput" type="password" name="oksifre" pattern="[a-zA-Z0-9]*"  title="Türkçe ve özel karakter girmeyiniz."  minlength="8" id="p1"/>
                    <label  class="kayitLabel">Şifre Tekrar</label>
                    <input class="kayitInput" type="password" name="oksifretekrar" onfocus="validatePass(document.getElementById('p1') , this);" oninput="validatePass(document.getElementById('p1') , this);" />
                    <script type="text/javascript" src="icerik/script/sifretekrar.js"> </script>
                    <label id="kaydet"  class="kayitLabel">Eğitim Fiyati</label>
                    <input id="kaybet" class="kayitInput" type="text" name="okfiyat"  />
                    <label  class="kayitLabel">Branşı</label>
                    <select class="kayitInput"  name="okbransi">
                        <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                        <option  value="<?php echo  $row1[0]; ?>"><?php echo $row1[2]; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <button type="submit" name="btnKayitOk" class="kayitButon">KAYDOL</button>
                    <a class="kayitA kayitButon" style="margin-top:7px;line-height: 2.2;" href="./giris.php"><p style="text-align: center; font-size: 18px;">Giris</p></a>
  
               </form>
           </div>
        </div>
        

        <input type="submit"  class="butonlar" onclick="document.getElementById('id02').style.display='block'"  value='ÖĞRENCİ'>
        <div id="id02" class="modal2">
            <div class="kayitIcerik">
                <form action="" method="POST">
                <span id="kapat"  class="kapat">&times;</span>
                <script type="text/javascript" src="icerik/script/closemodal.js"> </script>
                    <h2 class="kayitBaslik">ÖĞRENCİ KAYIT FORMU</h2>
                    <hr>
                    <br>
                    <label class="kayitLabel">Ad</label>
                    <input class="kayitInput" type="text" name="oadi"  />
                    <label class="kayitLabel">Soyad</label>
                    <input class="kayitInput" type="text" name="osoyadi"  />
                    <label  class="kayitLabel">Email</label>
                    <input class="kayitInput" type="email" name="oemail" />
                    <label  class="kayitLabel">Şifre</label>
                    <input class="kayitInput" type="password" name="osifre" id="asd" pattern="[a-zA-Z0-9]*"  title="Türkçe ve özel karakter girmeyiniz."   minlength="8"  require="required" id="p2" />
                    <label  class="kayitLabel">Şifre Tekrar</label>
                    <input class="kayitInput" type="password" name="osifretekrar" onfocus="validatePass(document.getElementById('p2') , this);" oninput="validatePass(document.getElementById('p2') , this);"  />
                    <script type="text/javascript" src="icerik/script/sifretekrar.js"> </script>
                   <button type="submit" name="btnKayitO" class="kayitButon" >KAYDOL</button>
                   <a class="kayitA kayitButon" style="margin-top:7px;line-height: 2.2;" href="./giris.php"><p style="text-align: center; font-size: 18px;">Giris</p></a>
               </form>
        </div>
    </div>
</div>
    
    <?php
    include './parcali/footer.php';
    ?>
 
</body>
</html>
