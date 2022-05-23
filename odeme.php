<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ödeme Yap</title>
</head>
<body style="background-color:powderblue;">  
    <?php
     include './parcali/menu.php';
     include './dbconnect.php';
    ?>
<?php

$EgitimId=$_GET["Eid"];
$EgitimIdcozum = base64_decode($EgitimId);
$Tutar=$_GET["manys"];
$Tutarcozum = base64_decode($Tutar);

 if (isset($_POST["submit"])) {
    if (strlen($_POST['adi']) != 0 && strlen($_POST['kartNo']) != 0 &&  strlen($_POST['sonkullanma']) != 0 && strlen($_POST['cvv']) != 0) {
       $sonkullanmatarihi = $_POST['sonkullanma'];
       
        $insert = $mysqli->query(" INSERT INTO tbl_odeme(KartAdi, KartNumara, KartCvv,SonKullanmaTarihi, EgitimAlanOgrenciId, OdenenTutar, OdemeTarihi) VALUES ('" . $_POST["adi"]  . "','" . $_POST["kartNo"]  . "','" . $_POST["cvv"]  . "','" . $_POST["sonkullanma"]  . "','$EgitimIdcozum', '$Tutarcozum' , NOW() )" );
        if($insert){
            $update = $mysqli->query("update tbl_egitimalanogrenciler set Durum='O' where Id =$EgitimIdcozum ");
              echo '<script> swal({
                title: "Ödemeniz Yapılmıştır.",
                type: "success",
                button: "Tamam",
            }).then(function() {
                location.replace("anasayfa.php");
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

    

<div class="odemeformu" style="margin-top:50px;">
          <div class="icerikodeme justify-content-center" >
              <div class=" col-lg-6 col-md-6"  style="margin:auto;">
                  <div class="card p-3">
                      <div class="row justify-content-center">
                          <div class="col-10">
                              <h2 class="heading text-center">Ödeme Formu</h2>
                          
                      </div>
                      <form action="" method="POST">
                          <div class="row justify-content-center mb-4 radio-group">
                              <div class="col-sm-3 col-5">
                                  <div class='radio selected mx-auto' data-value="dk"> <img class="fit-image" src="https://i.imgur.com/5TqiRQV.jpg" width="105px" height="55px"> </div>
                              </div>
                              <div class="col-sm-3 col-5">
                                  <div class='radio mx-auto' data-value="visa"> <img class="fit-image" src="https://i.imgur.com/OdxcctP.jpg" width="105px" height="55px"> </div>
                              </div>
                              <div class="col-sm-3 col-5">
                                  <div class='radio mx-auto' data-value="master"> <img class="fit-image" src="https://i.imgur.com/WIAP9Ku.jpg" width="105px" height="55px"> </div>
                              </div>
                              <div class="col-sm-3 col-5">
                                  <div class='radio mx-auto' data-value="paypal"> <img class="fit-image" src="https://i.imgur.com/cMk1MtK.jpg" width="105px" height="55px"> </div>
                              </div> <br>
                          </div>
                          <div class="row justify-content-center form-group">
                              <div class="col-10 px-auto">
                              </div>
                          </div>
                          <div class="row justify-content-center">
                              <div class="col-10">
                                  <div class="input-group"> <label>Kartın üzerinde yazan isim</label> <input type="text" name="adi" placeholder="Yavuz Temur"></div>
                              </div>
                          </div>
                          <div class="row justify-content-center">
                              <div class="col-10">
                                  <div class="input-group"> <label>Kart Numarası</label> <input type="text" pattern="[0-9]*"  title="Sadece Rakam Giriniz." name="kartNo" placeholder="0000 0000 0000 0000" minlength="16" maxlength="16">  </div>
                              </div>
                          </div>
                          <div class="row justify-content-center">
                              <div class="col-10">
                                  <div class="input-group"> <label>Odenecek Tutar</label> <input type="text"  name="buy" value=" <?php echo "$Tutarcozum "?> "  disabled>  </div>
                              </div>
                          </div>
                          <div class="row justify-content-center">
                              <div class="col-10">
                                  <div class="row">
                                      <div class="col-6">
                                          <div class="input-group"> <label>Son Kullanma Tarihi</label> <input onkeyup="$cc.expiry.call(this,event)" type="text"  name="sonkullanma" placeholder="MM/YY" minlength="5" maxlength="5"> 
                                          <script type="text/javascript" src="icerik/script/kartsonkullanma.js"> </script>
                                           </div>
                                      </div>
                                      <div class="col-6">
                                          <div class="input-group"> <label>CVV</label> <input type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;" minlength="3" maxlength="3">  </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row justify-content-center">
                          
                              <div class="col-md-12"> <button type="submit" name="submit"  style="width: 82%; margin-top: 15px;"class="kayitButon">Ödeme yap</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
     


      <a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

    <?php
    include './parcali/footer.php';
    ?>
  
 
</body>
</html>