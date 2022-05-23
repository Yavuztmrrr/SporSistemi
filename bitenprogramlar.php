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
  <title>Biten Çalisma Programı Listesi</title>


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
        $calismaprogramitarih = $_GET['tarih'];
        $calismaprogramitarihcozumu = base64_decode($calismaprogramitarih);
        $onlinekocId = $_GET['okid'];
        $onlinekocIdcozum = base64_decode($onlinekocId);

 
        $ogrenciId = $_GET['oid'];
        $ogrenciIdcozum = base64_decode($ogrenciId);

        $liste = $db->query("select ca.OgrenciTamamlamaDurum , ca.KayıtTarih ,ca.OgrenciId,ca.OnlineKocId, ca.Durum as CalismaDurum ,ca.HareketDetay, ca.Id as CalismaId , ha.Adi as Hakeretİsmi , ah.Adi as AltHareketİsmi , ah.name  from tbl_calismaprogrami ca inner join tbl_hareketisimleri ha on ha.Id=ca.hareketId inner join tbl_althareketisimleri ah on ah.Id = ca.HareketAltId where ca.KayıtTarih='$calismaprogramitarihcozumu' and ca.OnlineKocId =$onlinekocIdcozum  and ca.OgrenciId = $ogrenciIdcozum  ")->fetchAll(PDO :: FETCH_ASSOC);  
        
       
?>
        <div  style="background-color: powderblue;"  class="container py-5"></div>
            <header  class="text-center text-white">
                <h1 style="color:black; margin-bottom:40px;" class="display-4">BİTEN ÇALİŞMA PROGRAMI LİSTESİ</h1>
             </header>
        </div>

     <div  class=""  >
         <?php
            foreach ($liste as $key => $value) {
             
         ?>
            <div  style="margin-top:40px; "  class="col-md-15 col-md-pull-3">
                <section   class="search-result-item">
              
                <p  class="image-link" href="#"> <?php echo  '<img class="image" style="width: 100%;  height: 180px; " src="data:image/jpeg;base64, ' . base64_encode($value['name']) .'" ' ?>  
   
                </p>
                    <div   class="search-result-item-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4 class="search-result-item-heading"><h2> <?php echo  $value['Hakeretİsmi'] ?></h2></h4>
                                <h4 class="search-result-item-heading"><h4> <?php echo  $value['AltHareketİsmi'] ?></h4></h4>
                                <p class="description"><?php echo  $value['HareketDetay'] ?></p>
                            </div>
                            <div class="col-sm-3 text-align-right">

                               <br><p style="float:right" class="btn btn-primary btn-info btn-sm" href=""><?php echo  $value['OgrenciTamamlamaDurum'] ?></p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <?php
            }         
            ?>
            </div>
      

      </div>


      <?php
      
        $not = $db->query("select * from tbl_not where KayitTarih='$calismaprogramitarihcozumu' and OnlineKocId =$onlinekocIdcozum  and Ogrenci_Id = $ogrenciIdcozum  ")->fetchAll(PDO :: FETCH_ASSOC);  
        
        if($not!=null && count($not) > 0){
            echo '
            <div class="notListe" >
            <p class="notBaslik">Çalişmaya Ait Notlar</p>
           ';
                foreach ($not as $key => $value) {
             echo'
                <div>
                    <section   class="search-result-item">
                        <div   class="">
                                <div  class="col-sm-12">
                                    <p> Konu:  '. $value['Konu'] .' </p>
                                    <p> Not:  '.  $value['NotIcerik'] .' </p>
                                    </div>
                            </div>
                        </div>
                        <div style="height:20px; margin-top:10px" >
     
                        </div>
                    </section>          
                    ';
                }         
                echo'
            </div>
           </div>
          </div>
             ';
        }        
        ?>


   
    <?php
    include './parcali/footer.php';
    ?>

<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>


</body>
</html>


