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
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Eğitim</title>


</head>
<body style="background-color:powderblue";>  



<?php
    include './parcali/menu.php';
    include './dbconnect.php';

?>

<?php
        $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
        $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
      

        $liste=null;
        $result=null;
        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' " );
        $satir = $sonucOgrenci->fetch_row();
        if($satir>0){
          $listvarmi = $mysqli->query("SELECT * FROM tbl_calismaprogrami where OgrenciId=$girisYapanId  and ProgramDurumu = 'A' "  );
          $varmi = $listvarmi->fetch_row();
          $sayi=1;
          $sayi1=1;
          if($varmi==null  ){
            echo '<script> swal({
              title: "Calisma Programınız Bulunmamaktadır!",
              type: "success",
              button: "Tamam",
          }).then(function() {
              location.replace("anasayfa.php");
          }); </script>';
          }
          else{
            $liste = "SELECT * FROM tbl_egitimalanogrenciler where OgrenciId=$girisYapanId and Durum='O' ";
          
            $result = mysqli_query($mysqli, $liste); 

            while ($row1 = mysqli_fetch_array($result)):;
            $sayac_degeri = 1;
          
            $egitim = $db->query("select * from tbl_OnlineKoc where Id='".$row1[2]."' ")->fetch(PDO :: FETCH_ASSOC);
            $brans = $db->query("select * from tbl_brans where Id='".$egitim['BransId']."' ")->fetch(PDO :: FETCH_ASSOC);
            $calismaprogramı = "SELECT DISTINCT KayıtTarih FROM tbl_calismaprogrami where OgrenciId=$girisYapanId and ProgramDurumu='A' and OnlineKocId = '".$row1[2]."'    ";
            $calismaresult = mysqli_query($mysqli, $calismaprogramı);    
            if( $sayi==1){
                    echo'
                    <div class="egitimicerik" >
                    <div class="egitim container" style= "background-color: white;">
                            <div class="row">
                              <div class="col-12">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">OnlineKoc</th>
                                      <th scope="col">Çalışma Programı</th>
                                      <th scope="col">Tarih</th>
                                      <th scope="col">Branş</th>
                                      <th scope="col">İşlemler</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                  
                ';
                  $sayi=0;
              }
              while ($row1 = mysqli_fetch_array($calismaresult)):;
              echo '<tr>
              <th scope="row">'.$egitim['Adi'].' '.$egitim['Soyadi'].'</th>
              <td>Program ' . $sayac_degeri .'</td>
              ';
              
         
              echo'
              <td>'.$row1['KayıtTarih'].'</td>
              ';
      
              echo'
              <td>'.$brans['Adi'].'</td>
              <td>
              <a href="calismaprogramilisteleme.php?tarih=' . base64_encode($row1['KayıtTarih'])  . '&okid=' . base64_encode($egitim['Id'])  . '" class="mesajyollalink" ><button type="button" style="margin-left: 80px;" class="egitimcalismaprogrami">Çalışma Programı</i></button>  </a> 
              <a   href="mesaj.php"    class="mesajyollalink" ><button type="button" class="egitimmesajgonder">Mesaj Gönder</i></button>  </a> 
              </td>
            </tr>';
              $sayac_degeri = $sayac_degeri+1;
              ?>
              <?php
               endwhile;
                endwhile;
            
              if($sayi1==1){
                  echo'
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
                  ';
                
                  $sayi1=0;
                } 
          }
                  
        }
        else{
            $sayi=1;
            $sayi1=1;
          //SELECT * FROM tbl_egitimalanogrenciler eo inner join tbl_onlinekoc ogk on ogk.Id=eo.OnlineKocId where ogk.Id=$girisYapanId and Durum = 'O'
            $listvarmi = $mysqli->query("SELECT * FROM tbl_egitimalanogrenciler where OnlineKocId=$girisYapanId and Durum='O' " );
            $satir = $listvarmi->fetch_row();
                if($satir==null  ){
                    echo '<script> swal({
                      title: "Ogrenciniz bulunmamaktadır Ogrenci istek listenize bakınız!",
                      type: "success",
                      button: "Tamam",
                  }).then(function() {
                      location.replace("egitimonay.php");
                  }); </script>';
                  }
                  else{
                    $liste = "SELECT * FROM tbl_egitimalanogrenciler where OnlineKocId=$girisYapanId and Durum='O' ";
                    $result = mysqli_query($mysqli, $liste); 
                    while ($row1 = mysqli_fetch_array($result)):;
                    $egitim = $db->query("select * from tbl_ogrenci where Id='".$row1[1]."' ")->fetch(PDO :: FETCH_ASSOC);

                  
                    if( $sayi==1){
                        echo'
                        <div class="egitimicerik" >
                        <div class="egitim container" style= "background-color: white;">
                                 <div class="row">
                                   <div class="col-12">
                                     <table class="table table-bordered">
                                       <thead>
                                         <tr>
                                           <th scope="col">Öğrenci</th>
                                      
                                           <th scope="col">Tarih</th>
                                          
                                           <th scope="col">İşlemler</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                      
                    ';
                      $sayi=0;
                   }
                   echo '<tr>
                   <th scope="row">'.$egitim['Adi'].' '.$egitim['Soyadi'].'</th>
        
                   <td>'.$row1['KayitTarih'].'</td>
                   <td>
                   <a href="calismaekle.php?Oid=' . base64_encode($row1[1])  . '&Okid=' . base64_encode ($row1[0])  . '" class="mesajyollalink" ><button type="button" style="margin-left: 80px;" class="egitimcalismaprogrami">Çalışma Ekle</i></button>  </a> 
                   <a   href="egitimogrenciprofil.php?Oid=' . base64_encode($row1[1] ) .'"    class="mesajyollalink" ><button type="button" class="egitimmesajgonder">Profil</i></button>  </a> 
                   </td>
                 </tr>';
                 
                   ?>
                  <?php
                    endwhile;
                 
                  if($sayi1==1){
                      echo'
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                </div>
                      ';
                     
                      $sayi1=0;
                     } 
            }
                   
             
           
           
        }   
?>

                  
  
<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>
</body>
</html>

