<?php
include './yetki.php';
error_reporting(0);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src= "https://code.jquery.com/jquery-3.1.1.js" type="text/javascript"></script>
    

  <title>Çalişma Ekle</title>


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
      
        $ogrenciId =  $_GET['Oid'];
        $OgrenciIdcozum = base64_decode($ogrenciId);

        $liste=null;
        $result=null;
        $bransId = $db->query("select * from tbl_Onlinekoc where Id='".$girisYapanId."' ")->fetch(PDO :: FETCH_ASSOC);
        $liste = "SELECT  * FROM tbl_hareketisimleri where BransId ='". $bransId['BransId'] ."' ";
        $date=null;
        $dateformat=null;
        $result = mysqli_query($mysqli, $liste);
        $ekleresult = mysqli_query($mysqli, $liste);
       $sayi=1;
        if (count($_POST) > 0) {
            if(isset($_POST['calismaekle']))
            {     
              
                $ekle="INSERT INTO tbl_calismaprogrami ( HareketId,HareketAltId, HareketDetay, KayıtTarih, Durum, OnlineKocId, OgrenciId, OgrenciTamamlamaDurum, TamamlamaTarih,ProgramDurumu,Islem)
                values ('" .  $_POST["hareketad"] . "','" .  $_POST["althareketad"] . "','" .  $_POST["hareketdetay"] . "', 'NOW()' , 'CalismaSepet' , $girisYapanId,$OgrenciIdcozum,'Tamamlanmadi','NOW()','A','A'  ) ";
                  if(mysqli_query($mysqli,$ekle))
                      { 
                    
                          echo '<script> swal({
                            title: "Hareket başarılı şekilde eklenmiştir!",
                            button: "Tamam",
                        }); </script>';
                      }                   
              } 
        }
?>  
        <div style="width: 80%;  margin:auto; padding: 60px;     background-color: rgb(149, 208, 241); margin-top:50px">    
        <H2 style="text-align: center; margin-bottom:20px;">Çalişma Programı Ekle</H2>     
            <form class="" method="POST"  enctype="multipart/form-data">
            <script type="text/javascript" src="icerik/script/resimkontrol.js"> </script>
            
                <div  class="form-group row ">
              
                  <select class="filecalisma" id="hareket" style="margin-right: 40px; width: 200px;" name="hareketad" id="ad">
                  <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                    <option class=""  value="<?php echo  $row1["Id"]; ?> "><?php echo $row1['Adi']; ?></option>
                    <?php endwhile;  ?>  
                  </select>
                  <select class="filecalisma" id="althareket" style="margin-right: 40px; width: 200px;" name="althareketad" id="ad">
                  <option class=""  value=" ">Hareket Seçiniz</option>
                  </select>

                  <script type="text/javascript">
                    $(document).ready(function(){
                      $("#hareket").change(function(){
                        var hareketid = $(this).val(); 
                        $.ajax({
                          type : "POST",
                          url : "althareketgetir.php",
                          data : {"hareket":hareketid},
                          success : function(e)
                          {
                            $("#althareket").show();
                            $("#althareket").html(e);
                           
                          }
                        });
                        
                      })
                    });
                  </script>


                  <input class="calismaeklerow" name="hareketdetay" style="width: 300px;  margin:0 auto;" type="text"   placeholder="Tekrar" required>
                  <button style="width: 20%;   " name="calismaekle" class="calismaBtnilk">Ekle</button>             
                  <div  class="col-sm-10">                  
                  </div>
                </div>
                <hr>
            
                
                <div class="form-group row">
                  <div class="col-sm-10"> 
                  
                  
                  
                  </div>
                </div>
            </form>
           </div>

            <?php
            
            $list = $db->query("select ha.Id as HareketId,ah.Id as AltHareketId , ca.OgrenciId,ca.OnlineKocId, ca.Durum as CalismaDurum ,ca.HareketDetay, ca.Id as CalismaId , ha.Adi as Hakeretİsmi , ah.Adi as AltHareketİsmi , ah.name  from tbl_calismaprogrami ca inner join tbl_hareketisimleri ha on ha.Id=ca.hareketId inner join tbl_althareketisimleri ah on ah.Id = ca.HareketAltId where ca.Durum='CalismaSepet' and ca.Islem = 'A' and OgrenciId= $OgrenciIdcozum and OnlineKocId = $girisYapanId  ")->fetchAll(PDO :: FETCH_ASSOC);
           
            if (count($_POST) > 0) {
              if(isset($_POST['update'])){
              if (
                strlen($_POST['date']) != 0  ) {
              
             //   $query= "UPDATE tbl_calismaprogrami set Durum = 'CalismaOnay' , KayıtTarih = '" .  $_POST["date"] . "' where OgrenciId =$OgrenciIdcozum and OnlineKocId = $girisYapanId and Islem = 'A'  ";
             foreach ($list as $key => $value) {
               $query="INSERT INTO tbl_calismaprogrami ( HareketId,HareketAltId, HareketDetay, KayıtTarih, Durum, OnlineKocId, OgrenciId, OgrenciTamamlamaDurum, TamamlamaTarih,ProgramDurumu,Islem)
                values ('".$value['HareketId']."','" .  $value['AltHareketId'] . "','" .  $value['HareketDetay'] . "', '" .  $_POST["date"] . "' , 'CalismaOnay' , $girisYapanId,$OgrenciIdcozum,'Tamamlanmadi','NOW()','A','A'  ) ";
            
              if(mysqli_query($mysqli,$query))
                      { 
                   
                          echo '<script> 
                          swal({
                            title: "Çalişma Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("calismaekle.php?Oid=' . base64_encode($OgrenciIdcozum)  . '&Okid=' . base64_encode ($girisYapanId)  . '");
                        });
                        </script>';
                      }      
                     
                      }
              }
              else {
                echo '<script> 
                swal({
                  title: "Tarih seçiniz",
                  type: "success",
                  button: "Tamam",
              }).then(function() {
                  location.replace("calismaekle.php?Oid=' . base64_encode($OgrenciIdcozum)  . '&Okid=' . base64_encode ($girisYapanId)  . '");
              });
              </script>';
            }
            }
          }
           
           ?>
           <?php
             $liste = $db->query("select ha.Id as HareketId,ah.Id as AltHareketId , ca.OgrenciId,ca.OnlineKocId, ca.Durum as CalismaDurum ,ca.HareketDetay, ca.Id as CalismaId , ha.Adi as Hakeretİsmi , ah.Adi as AltHareketİsmi , ah.name  from tbl_calismaprogrami ca inner join tbl_hareketisimleri ha on ha.Id=ca.hareketId inner join tbl_althareketisimleri ah on ah.Id = ca.HareketAltId where ca.Durum='CalismaSepet' and ca.Islem = 'A' and OgrenciId= $OgrenciIdcozum and OnlineKocId = $girisYapanId  ")->fetchAll(PDO :: FETCH_ASSOC);
           
             if(isset($_POST['sil'])){
              foreach ($liste as $key => $value) {
               $query= "Delete from tbl_calismaprogrami where Id = '".$value['CalismaId']."' ";
                if(mysqli_query($mysqli,$query))
                { 
             
                    echo '<script> 
                    swal({
                      title: "Çalişma Kaldırılmıstır!",
                      type: "success",
                      button: "Tamam",
                  }).then(function() {
                      location.replace("calismaekle.php?Oid=' . base64_encode($OgrenciIdcozum)  . '&Okid=' . base64_encode ($girisYapanId)  . '");
                  });
                  </script>';
                }      
             }
            }

           ?>

        <div style="width: 80%;  margin:auto; padding: 60px;     background-color: rgb(149, 208, 241); margin-top:50px">    
            <H2 style="text-align: center; margin-bottom:20px;">Çalişma Ekle Onayı</H2>     
               <form class="" method="POST"  enctype="multipart/form-data">
               <?php
               $sayi=1;
               $sayi1 = 1;
               echo '
                <table class="table" style="background-color:white">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Hareket Adi</th>
                    <th scope="col">Hareket Alt Adi</th>
                    <th scope="col">Hareket Detay</th>
                    <th scope="col">Hareket Resim</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                
                ';
            foreach ($list as $key => $value) {
                  echo '
                  </thead>
                  <tbody>
                  <tr>
               
                  <th  scope="row">'.$value['CalismaId'].'</th>
                  <td name = "hareketadd" value="'.$value['HareketId'].'" >'.$value['Hakeretİsmi'].'</td>
                  <td  name = "althareketadd">'.$value['AltHareketİsmi'].'</td>
                  <td name = "hareketdetayy">'.$value['HareketDetay'].'</td>
                  <td><img class="image" style="width: 50px;  height: 40px; " src="data:image/jpeg;base64, ' . base64_encode($value['name']) .'"/></td>
                  <td><a href="calismasil.php?id='.$value['CalismaId'].'&Oid=' . base64_encode($OgrenciIdcozum)  . '&Okid=' . base64_encode ($girisYapanId)  . ' "  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a> </td>
                  <script type="text/javascript" src="icerik/script/sil.js"> </script>
                </tr>
                  
                  ';

              if($sayi1=1){

                echo '
                

                ';
                $sayi1=0;
              }
           }
                    
            ?>
</tbody>
</table>
   
<div class="form-group row ">
                <label class="tarihyazi"  for="start"> Tarih:</label>
                  <div class="col-sm-10">
                  <input type="date" class="tarihcalisma" id="date" min ='<?php echo date('Y-m-d');?>'max="2099-12-31"  name="date"   >
                  <br>
                    </div>
                </div>


                <div class="form-group row">
                <div class="col-sm-10"> 
              
                <a href="calguncelonay.php?ogrenciId=<?php  echo  base64_encode($OgrenciIdcozum)?> "style="width: 25%; float: right;  "  name="guncelle"  class="calismaBtnEkle" >  Çalışma Güncelle </a>
                <button type="submit" style="width: 25%; float: right; " name="update" id="update" class="calismaBtn">Çalışma Ekle</button>

                <button type="submit" style="width: 25%; float: right; " name="sil" id="sil" class="calismaBtn">Sil</button>
  
                  </div>
                </div>
            </form>
           </div>


           <a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>
</body>
</html>
