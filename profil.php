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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.nickshare.in/kik/static/files/js/jquery.filter_input.js"></script>
  <script src="https://cdn.anychart.com/releases/8.9.0/js/anychart-bundle.min.js"></script>


  <title>Profil</title>
</head>

<body style="background-color:powderblue;">
  <?php
  include './parcali/menu.php';
  include './dbconnect.php';
  include './islem.php';
  ?>
  <?php

  $girisYapanId = $_SESSION["sporsistemi"][0]['Id'];
  $girisYapanEmail = $_SESSION["sporsistemi"][0]['Email'];

  $liste = null;
  $result = null;
  $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' ");
  $satir = $sonucOgrenci->fetch_row();
  if ($satir > 0) {
    $liste = "SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail'  ";
    $result = mysqli_query($mysqli, $liste);
    // alttaki listeleme için 

    $vucutkitleliste = $mysqli->query("select * from tbl_vucutkitleindeksi where OgrenciId= $girisYapanId order by Id desc limit 0,15  ");

    while ($row1 = mysqli_fetch_array($result)) :;

      echo '  <div style=" background-color: powderblue;"  class="container mt-3 mb-4">
              <div  class="col-lg-9 mt-4 mt-lg-0">
                  <div  class="row">
                    <div class="col-md-12">
                      <div  id="boyut" class="user-dashboard-info-box ">
                        <table   class="table manage-candidates-top mb-0">
                          <thead >
                            <tr>
                              <th>Kullanıcı Bilgileri</th>
                              <th class="text-center">Durumu</th>
                              <th class="text-center"></th>
                              <th class="action text-right"> Bilgileri Güncelle</th>
                            </tr>
                          </thead>
                          <tbody >
                            <tr class="candidates-list">
                              <td class="title">
                              <div class="thumb">
                              <img style=" "  class="img-fluid" src="img/bos.jpg" alt="">
                            </div>
                                <div class="candidate-list-details">
                                  <div class="candidate-list-info">
                                    <div class="candidate-list-title">
                                    <br>
                                       <h5 class="mb-0"><a href="#">' . $row1[1] . ' '  . $row1[2]  .  '</a></h5>
                                  
                                    </div>
                                    <div class="candidate-list-option">
                                      <ul class="list-unstyled">
                                      <li><i class="fa fa-filter pr-1"></i>' . $row1[3] . '</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              
                              <td class="candidate-list-favourite-time text-center">
                             <br>
                                <span class="candidate-list-time order-1"> Öğrenci </span>
                               
                              </td>
                              <td class="candidate-list-favourite-time text-center">
                               
                              </td>
                              <td>
                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                
                                <button  onclick="javascript:hide2();"  style="margin-top:15px; margin-right:7px; width:140px" class="kayitButon" style="width: 120px;">GÜNCELLE</button>
    
                                </ul>
                              </td>
                            </tr>                          
                          </tbody>
                        </table>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                  <div id="id02" class="modal2">
                    <div class="kayitIcerik">
                        <form action="" method="POST">
                        <span id="kapat"  class="kapat">&times;</span>
                        <script type="text/javascript" src="icerik/script/closemodal.js"> </script>
                            <h3 class="kayitBaslik">ÖĞRENCİ KAYIT FORMU</h3>
                            <hr>
                            <br>
                            <label class="kayitLabel">Ad</label>
                            <input class="kayitInput" type="text" value="' . $row1['Adi'] . '" name="oadi" disabled  />
                            <label class="kayitLabel">Soyad</label>
                            <input class="kayitInput" type="text" value="' . $row1['Soyadi'] . '" name="osoyadi" disabled  />
                            <label  class="kayitLabel">Email</label>
                            <input class="kayitInput" type="email" value="' . $row1['Email'] . '" name="oemail" disabled />
                            <label  class="kayitLabel">Şifre</label>
                            <input class="kayitInput" type="text" value="' . $row1['Sifre'] . '" name="osifre" id="asd" pattern="[a-zA-Z0-9]*"  title="Türkçe ve özel karakter girmeyiniz."   minlength="8"  require="required" id="p2" />
                            <label  class="kayitLabel">Şifre Tekrar</label>
                            <input class="kayitInput" type="text" value="' . $row1['Sifre'] . '" name="osifretekrar"   />
                          
                            <button type="submit" name="btnGuncelleO" class="kayitButon guncelle">Güncelle</button>
                      </form>
                </div>
            </div>
        </div>
        
            <div class="vucutKitle" >
              <p class="vucutKitleBaslik">Vücut Kitle İndeksi </p>
              <form action="" method="POST">
                  <div class="form-row">
                    <div class="col">
                      <input type="number" name="boy" class="form-control" placeholder="Boy">
                    </div>
                    <div class="col">
                      <input type="number" name="kilo" class="form-control" placeholder="Kilo">
                    </div>
                  </div>
                  <input type="submit" style="display:none;" name="Hesapla" class="vucutKitlebtn"  name="Hesapla" value="Hesapla">
              </form>
            </div>';

    endwhile;
    $sayi = 1;
    for ($i = 0; $i < $vucutkitleliste->num_rows; $i++) {
      $satir = $vucutkitleliste->fetch_row();

      echo  ' <div class="table">
          <table class="vucutKitleTabloUst"   class="table">
          ';
      if ($sayi == 1) {
        $sayi = 0;
        echo ' 
              <tr>
                <th scope="col">#</th>
                <th scope="col">Boy</th>
                <th scope="col">Kilo</th>
                <th scope="col">Tarihi</th>
                <th scope="col">Vucut kitle indeksi</th>
            </tr>
                  ';
      }
      echo '
              <tr>
                <th class="vucutKitleTablo"   scope="row">' . $i . '</th> 
                <td class="vucutKitleTablo">' . $satir[1] . '</td>
                <td class="vucutKitleTablo">' . $satir[2] . '</td>
                <td class="vucutKitleTablo">' . $satir[4] . '</td> 
                <td class="vucutKitleTablo">' . $satir[5] . '</td> 
              </tr>     
        </table>    
       </div>
    
       ';
    }
    $vucutkitleGrafik = $mysqli->query("select * from tbl_vucutkitleindeksi where OgrenciId= $girisYapanId order by Id desc limit 0,15 ");
    echo '
        <div class="vucutKitleGrafik">
              <div  class="grafikGoster">
                      <button id="grafikGizle" class="vucutKitlebtn">Grafik Olarak Goster</button>
                      <br>
                      <br>
              </div>
              <div style=" display:none; width: 100%; height:300px; margin: 0 auto;" id="container"></div>
              <script type="text/javascript" src="icerik/script/grafikackapa.js"> </script>
        </div>
        ';
    echo '<script>
                anychart.onDocumentLoad(function() {
                var chart = anychart.column();
                chart.data({header: ["#", "Kilo", "Boy", "Vucut Kitle İndeksi"],
                 rows:[
                  ';
    for ($i = 0; $i < $vucutkitleGrafik->num_rows; $i++) {
      $satir = $vucutkitleGrafik->fetch_row();
      $Kilo = $satir[2];
      $Boy = $satir[1];
      $Orani = $satir[6];
      $Tarih = $satir[4];
      echo '
                  {x: "' . $i . '", Kilo:' . $Kilo . ', Boy: ' . $Boy . ', Vucut: ' . $Orani . '},
                      ';
    }
    $sayi1 = 1;
    if ($sayi1 = 1) {
      echo '
                  ]});
                  chart.title("Güncel Vücut Kitle İndeksi Grafiği ");  
                  chart.legend(true);
                  chart.container("container").draw();         
                  });
                  </script>
                     ';
      $sayi1 = 0;
    }



    echo '
    <div class="calismaProgrami">
       <p class="calismaProgramiBaslik"> Biten Çalışma Programları </p>
    </div>
    ';
    $sayi1 = 1;
    $deger = 1;
    $ogrencivarmi = "SELECT * FROM tbl_egitimalanogrenciler where OgrenciId=$girisYapanId and Durum='O' ";
    $result = mysqli_query($mysqli, $ogrencivarmi);
    while ($row1 = mysqli_fetch_array($result)) :;
      $sayac_degeri = 1;

      $egitim = $db->query("select * from tbl_OnlineKoc where Id='" . $row1[2] . "' ")->fetch(PDO::FETCH_ASSOC);
      $brans = $db->query("select * from tbl_brans where Id='" . $egitim['BransId'] . "' ")->fetch(PDO::FETCH_ASSOC);

      $calismaprogramı = "SELECT DISTINCT KayıtTarih FROM tbl_calismaprogrami where OgrenciId=$girisYapanId and ProgramDurumu='B' and OnlineKocId = '" . $row1[2] . "'    ";
      $calismaresult = mysqli_query($mysqli, $calismaprogramı);
      if ($deger == 1) {
        echo '
         
                <div class="profilegitimicerik" >
                <div class="egitim container" style= "background-color: white;">
                        <div class="row">
                          <div class="col-12">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="text-align:center" scope="col">Branş</th>
                                  <th style="text-align:center" scope="col">Çalışma Programı</th>
                                  <th style="text-align:center" scope="col">Tarih</th>
                                  <th style="text-align:center" scope="col">İşlem</th>
                                </tr>
                              </thead>
                              <tbody>
              
            ';
        $deger = 0;
      }
      while ($row1 = mysqli_fetch_array($calismaresult)) :;
        echo '
        <tr>
        <th style="text-align:center" scope="row">' . $brans['Adi'] . '</th>
        <td style="text-align:center">Program ' . $sayac_degeri . '</td>
        <td style="text-align:center">' . $row1['KayıtTarih'] . '</td>
        <td>
        <a href="bitenprogramlar.php?tarih=' . base64_encode($row1['KayıtTarih'])  . '&okid=' . base64_encode($egitim['Id'])  . '&oid=' . base64_encode($girisYapanId)  . '" class="mesajyollalink" ><button type="button" style="margin-left: 80px;" class="profilegitimcalismaprogrami">Çalışma Programı</i></button>  </a> 
        </td>
      </tr>';
        $sayac_degeri = $sayac_degeri + 1;

      endwhile;
      endwhile;
    if ($sayi1 == 1) {
      echo '
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
                ';
  
      $sayi1 = 0;
    }
  } else {
    $liste = "SELECT * FROM tbl_onlinekoc where Id = $girisYapanId and Email = '$girisYapanEmail' ";
    $result = mysqli_query($mysqli, $liste);
    while ($row1 = mysqli_fetch_array($result)) :;

      echo '  <div  background-color: powderblue;"  class="container mt-3 mb-4">
             <div  class="col-lg-9 mt-4 mt-lg-0">
                 <div  class="row">
                   <div class="col-md-12">
                     <div id="boyut" class="user-dashboard-info-box ">
                       <table   class="table manage-candidates-top mb-0">
                         <thead >
                           <tr>
                             <th>Kullanıcı Bilgileri</th>
                             <th class="text-center">Durumu</th>
                             <th class="text-center">Eğitim Fiyatı</th>
                             <th class="action text-right"> Bilgileri Güncelle</th>
                           </tr>
                         </thead>
                         <tbody >
                           <tr class="candidates-list">
                             <td class="title">
                             <div class="thumb">
                             <img style=" "  class="img-fluid" src="img/bos.jpg" alt="">
                           </div>
                               <div class="candidate-list-details">
                                 <div class="candidate-list-info">
                                   <div class="candidate-list-title">
                                   <br>
                                      <h5 class="mb-0"><a href="#">' . $row1[1] . ' '  . $row1[2]  .  '</a></h5>
                                 
                                   </div>
                                   
                                   <div class="candidate-list-option">
                                     <ul class="list-unstyled">
                                     
                                       <li><i class="fa fa-filter pr-1"></i>' . $row1[3] . '</li>
                                     </ul>
                                   </div>
                                 </div>
                               </div>
                             </td>
                             
                             <td class="candidate-list-favourite-time text-center">
                             <br>
                               <span class="candidate-list-time order-1"> Online Koç </span>
                              
                             </td>
                             <td class="candidate-list-favourite-time text-center">
                             <br>
                             <span class="candidate-list-time order-1">' . $row1[7] . ' TL</span>
                           </td>
                             <td>
                               <ul class="list-unstyled mb-0 d-flex justify-content-end">
                               
                            <button  onclick="javascript:hide();" style="margin-top:15px; margin-right:7px; width:140px" class="kayitButon" style="width: 120px;">GÜNCELLE</button>
   
                               </ul>
                             </td>
                           </tr>         
                         </tbody>
                       </table>
                       
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             
        
        <div id="id01"  class="modal">
            <div class="kayitIcerik">
                <form action="" method="POST">
                <span  class="kapat" >&times;</span>
                <script type="text/javascript" src="icerik/script/closemodal.js"> </script>
                    <h3 class="kayitBaslik">ONLİNE KOÇ GÜNCELLEME FORMU</h3>
                    <hr>
                    <input class="kayitInput" type="text" value="' . $row1['Adi'] . '" name="okadi" disabled/>
                    
                    <label class="kayitLabel">Soyad</label>
                    <input class="kayitInput" type="text"  value="' . $row1['Soyadi'] . '" name="oksoyadi" disabled/>
                    <label  class="kayitLabel">Email</label>
                    <input class="kayitInput" type="email"  value="' . $row1['Email'] . '" name="okemail" disabled />
                    <label  class="kayitLabel">Şifre</label>
                    <input class="kayitInput" type="text"  value="' . $row1['Sifre'] . '" name="oksifre" pattern="[a-zA-Z0-9]*"  minlength="8" id="p1" require="required"/>
                    <label  class="kayitLabel">Şifre Tekrar</label>
                    <input class="kayitInput" type="text" value="' . $row1['Sifre'] . '" name="oksifretekrar" );" />
                    <label id="kaydet"  class="kayitLabel">Eğitim Fiyati</label>
                    <input id="kaybet" class="kayitInput"  value="' . $row1['EgitimFiyati'] . '" type="text" name="okfiyat"  />

                    <button type="submit"  name="btnGuncelleOk" class="kayitButon guncelle">Güncelle</button>
               </form>
           </div>
        </div>';

    endwhile;

    echo '<div style=" width:100%;height:300px; "  >
        
            </div>';
  }
  ?>

  <?php

  if (isset($_POST["btnGuncelleOk"])) {
    if (strlen($_POST['oksifre']) != 0 && strlen($_POST['oksifretekrar']) != 0 && strlen($_POST['okfiyat']) != 0) {
      $sifreIlk = $_POST['oksifre'];
      $sifreIkı = $_POST['oksifretekrar'];
      if ($sifreIlk != $sifreIkı) {
        echo '<script> swal({
                         title: "Şifreler uyuşmuyor",
                        button: "Tamam",
                       }); </script>';
      } else {
        $aktifetOnlineKoc = execDb(" UPDATE tbl_onlineKoc SET EgitimFiyati='" . $_POST["okfiyat"]  . "', Sifre='" . $_POST["oksifre"]  . "' WHERE Id=$girisYapanId");
        $sonucOnlineKoc = execDb("select * from tbl_onlinekoc where Id=$girisYapanId ");
        //  var_dump($sonucOnlineKoc);
        if ($sonucOnlineKoc != null && count($sonucOnlineKoc) > 0) {
          echo '<script type="text/javascript" src="icerik/script/basarılıbilgiguncelledi.js"> </script>';
        } else {
          echo '<script> swal({
                      title: "Guncelleme Başarısızdır",
                      button: "Tamam",
                    }); </script>';
        }
      }
    } else {
      echo '<script> swal({
                 title: "Başarısız!",
                 button: "Tamam",
               }); </script>';
    }
  }
  ?>

  <?php
  if (isset($_POST["btnGuncelleO"])) {
    if (strlen($_POST['osifre']) != 0 && strlen($_POST['osifretekrar']) != 0) {
      $sifreIlk = $_POST['osifre'];
      $sifreIkı = $_POST['osifretekrar'];
      if ($sifreIlk != $sifreIkı) {
        echo '<script> swal({
                title: "Şifreler uyuşmuyor",
               button: "Tamam",
              }); </script>';
      } else {
        $aktifetOgrenci = execDb(" UPDATE tbl_ogrenci SET  Sifre='" . $_POST["osifre"]  . "' WHERE Id=$girisYapanId");
        $sonucOgrenci = execDb("select Id from tbl_ogrenci where Id=$girisYapanId and Sifre ='" . $_POST["osifre"]  . "' ");
        var_dump($sonucOgrenci);
        if ($sonucOgrenci != null && count($sonucOgrenci) > 0) {
          echo '<script type="text/javascript" src="icerik/script/basarılıbilgiguncelledi.js"> </script>';
        } else if ($sonucOgrenci[0] == null) {
          echo '<script> swal({
                title: "Guncelleme Başarısızdır",
                button: "Tamam",
            }); </script>';
        }
      }
    } else {
      echo '<script> swal({
        title: "Başarısız!",
        button: "Tamam",
      }); </script>';
    }
  }
  ?>
  <?php
  if (isset($_POST["Hesapla"])) {
    if (strlen($_POST['boy']) != 0 && strlen($_POST['kilo']) != 0) {
      $boy = $_POST['boy'];
      $kilo = $_POST['kilo'];

      $boy = $boy / 100;
      $vki = $kilo / ($boy * $boy);
      $vki = round($vki, 2);

      if ($vki < 20) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , CURTIME() ,'Zayif','$vki')");
        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki >= 20 && $vki <= 24.9) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Normal','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki >= 25 && $vki <= 29.9) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Hafif Şişman','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki >= 30 && $vki <= 34.9) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Şişman','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki >= 35 && $vki <= 44.9) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Aşiri Şişmanlık','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki >= 45 && $vki <= 49.9) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Tehlikeli Şişmanlık','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else if ($vki > 49.9 && $vki <= 60) {
        $sonucOgrenci = execDb("INSERT INTO tbl_vucutkitleindeksi(Boy,Kilo,OgrenciId,KayıtTarih,Durumu,Orani)values ('" . $_POST["boy"]  . "', '" . $_POST["kilo"]  . "', '$girisYapanId' , NOW() ,'Obez','$vki')");

        echo '<script> location.replace("profil.php"); </script>';
      } else {
        echo '<script> swal({
                title: "Değerleri Yanlıs Girilmis vucut kitle indeksi hesaplanmamıstır Doğru Giriniz",
                button: "Tamam",
            }); </script>';
      }
    } else {
      echo '<script> swal({
            title: "Boş Alan Bırakmayınız!",
            button: "Tamam",
        }); </script>';
    }
  }
  ?>


  <a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

  <?php
  include './parcali/footer.php';
  ?>
  <script type="text/javascript">
    function hide() {
      document.getElementById('id01').style.display = 'block'
    }
  </script>
  <script type="text/javascript">
    function hide2() {
      document.getElementById('id02').style.display = 'block'
    }
  </script>
</body>

</html>