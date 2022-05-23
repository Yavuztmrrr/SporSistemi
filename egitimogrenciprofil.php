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

  <title>Eğitim Ogrenci Profili</title>


</head>
<body style="background-color:powderblue";>  



<?php
    include './parcali/menu.php';
    include './dbconnect.php';
    include './islem.php';
?>

<?php
    $OgrenciId=$_GET["Oid"];
    $OgrenciIdcozum = base64_decode($OgrenciId);
    $girisYapanId = $_SESSION["sporsistemi"][0]['Id'];
    $girisYapanEmail = $_SESSION["sporsistemi"][0]['Email'];

        $liste=null;
        $result=null;
        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id =$OgrenciIdcozum  " );
        $satir = $sonucOgrenci->fetch_row();

        if($satir>0){
            $liste = "SELECT * FROM tbl_ogrenci where Id = $OgrenciIdcozum   "; 
            $result = mysqli_query($mysqli, $liste);  
           
            $vucutkitleliste = $mysqli->query("select * from tbl_vucutkitleindeksi where OgrenciId= $OgrenciIdcozum order by Id desc limit 0,15  "); 
    
             while ($row1 = mysqli_fetch_array($result)) :;
                 
          echo'  <div style=" background-color: powderblue;"  class="container mt-3 mb-4">
                  <div  class="col-lg-9 mt-4 mt-lg-0">
                          <div  id="boyut" class="user-dashboard-info-box ">
                            <table   class="table manage-candidates-top mb-0">
                              <tbody >
                                <tr class="candidates-list">
                                  <td class="title">
                                </div>
                                    <div class="candidate-list-details">
                                      <div class="candidate-list-info">
                                        <div class="candidate-list-title">
                                        <br>
                                           <h5 class="mb-0"><a href="#">' . $row1[1] . ' '  . $row1[2]  .  '</a></h5>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>                          
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <div class="vucutKitle" >
               <p class="vucutKitleBaslik">Vücut Kitle İndeksi </p>
         
            </div>';
                    
            endwhile ;
            $sayi=1;
            for ($i = 0; $i < $vucutkitleliste->num_rows; $i++) {
              $satir = $vucutkitleliste->fetch_row();
             
              echo  ' <div class="table">
              <table class="vucutKitleTabloUst"   class="table">
              '; 
                if($sayi==1){
                  $sayi=0;
                  echo' 
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Boy</th>
                    <th scope="col">Kilo</th>
                    <th scope="col">Tarihi</th>
                    <th scope="col">Vucut kitle indeksi</th>
                </tr>
                      ';
                    }
                    echo'
                  <tr>
                    <th class="vucutKitleTablo"   scope="row">' . $i. '</th> 
                    <td class="vucutKitleTablo">' . $satir[1] . '</td>
                    <td class="vucutKitleTablo">' . $satir[2] . '</td>
                    <td class="vucutKitleTablo">' . $satir[4] . '</td> 
                    <td class="vucutKitleTablo">' . $satir[5] . '</td> 
                  </tr>     
            </table>    
           </div>
        
           ';
            
            }
            $vucutkitleGrafik = $mysqli->query("select * from tbl_vucutkitleindeksi where OgrenciId= $OgrenciIdcozum order by Id desc limit 0,15 "); 
            echo'
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
                      for($i = 0; $i < $vucutkitleGrafik->num_rows; $i++){
                      $satir = $vucutkitleGrafik->fetch_row();
                      $Kilo= $satir[2];
                      $Boy=$satir[1];
                      $Orani=$satir[6];
                      $Tarih=$satir[4];   
                      echo'
                      {x: "'.$i.'", Kilo:'.$Kilo.', Boy: '.$Boy.', Vucut: '.$Orani.'},
                          '; 
                        }
                     $sayi1=1;
                      if($sayi1=1){
                      echo '
                      ]});
                      chart.title("Güncel Vücut Kitle İndeksi Grafiği ");  
                      chart.legend(true);
                      chart.container("container").draw();         
                      });
                      </script>
                         ';
                     $sayi1=0;            
            }
                            

                  
        }
        else{
           
             
           
           
        }   
?>

<?php

  echo '
    <div class="calismaProgrami">
       <p class="calismaProgramiBaslik">  Çalışma Programları </p>
    </div>
    ';
    $sayi1 = 1;
    $deger = 1;
    $ogrencivarmi = "SELECT * FROM tbl_egitimalanogrenciler where OgrenciId=$OgrenciIdcozum and Durum='O'  limit 1";
    $result = mysqli_query($mysqli, $ogrencivarmi);
    while ($row1 = mysqli_fetch_array($result)) :;
      $sayac_degeri = 1;

      $egitim = $db->query("select * from tbl_OnlineKoc where Id=$girisYapanId ")->fetch(PDO::FETCH_ASSOC);
      $brans = $db->query("select * from tbl_brans where Id='" . $egitim['BransId'] . "' ")->fetch(PDO::FETCH_ASSOC);

      $calismaprogramı = "SELECT DISTINCT KayıtTarih , ProgramDurumu FROM tbl_calismaprogrami where OgrenciId=$OgrenciIdcozum and OnlineKocId = $girisYapanId   ";
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
                                <th style="text-align:center" scope="col">Çalışma Programı</th>
                                <th style="text-align:center" scope="col">Tarih</th>
                                  <th style="text-align:center" scope="col">Durum</th>
                          
                         
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
        <td style="text-align:center">Program ' . $sayac_degeri . '</td>
        <td style="text-align:center">' . $row1['KayıtTarih'] . '</td>
        <th style="text-align:center" scope="row">' . $row1['ProgramDurumu'] . '</th>
       
        <td>
        <a href="bitenprogramlar.php?tarih=' . base64_encode($row1['KayıtTarih'])  . '&okid=' . base64_encode($girisYapanId)  . '&oid=' . base64_encode($OgrenciIdcozum)  . '" class="mesajyollalink" ><button type="button" style="margin-left: 80px;" class="profilegitimcalismaprogrami">Çalışma Programı</i></button>  </a> 
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

?>

<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>
</body>
</html>

