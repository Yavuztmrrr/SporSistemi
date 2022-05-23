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
  <title>Çalışma Guncelle</title>


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
      

        $liste=null;
        $result=null;
        $ogrenciId =  $_GET['ogrenciId'];
        $onlinekocıd =  $_GET['onlinekocId'];
        $date =  $_GET['date'];
        $ogrenciIdCozum= base64_decode($ogrenciId);
        $onlinekocIdCozum= base64_decode($onlinekocıd);
        $datecozum= base64_decode($date);
        
        $list = $db->query("select ca.OgrenciId,ca.OnlineKocId, ca.Durum as CalismaDurum ,ca.HareketDetay, ca.Id as CalismaId , ha.Adi as Hakeretİsmi , ah.Adi as AltHareketİsmi , ah.name  from 
        tbl_calismaprogrami ca inner join tbl_hareketisimleri ha on ha.Id=ca.hareketId inner join tbl_althareketisimleri ah on ah.Id = ca.HareketAltId where ca.Durum = 'CalismaSepet' and OgrenciId= $ogrenciIdCozum and OnlineKocId = $girisYapanId  ")->fetchAll(PDO :: FETCH_ASSOC);
        
        $liste = "SELECT ca.Id as calismaId , ca.KayıtTarih, ca.HareketDetay as HareketDetay, ha.Adi as Hareketİsmi , ah.name  as name, ah.Adi as AltHareketAdi  FROM tbl_calismaprogrami ca inner join tbl_hareketisimleri ha on ha.Id = ca.HareketId inner join tbl_althareketisimleri ah on ah.Id = ca.HareketAltId where ca.KayıtTarih = '$datecozum' and ca.OnlineKocId=$onlinekocIdCozum and ca.OgrenciId =$ogrenciIdCozum ";
        $result = mysqli_query($mysqli, $liste);
        $update = mysqli_query($mysqli, $liste);
        $kayitvarmi = $db->query("SELECT  * FROM tbl_calismaprogrami where KayıtTarih = '$datecozum' and OnlineKocId=$onlinekocIdCozum and OgrenciId =$ogrenciIdCozum and Durum = 'CalismaOnay'")->fetch(PDO :: FETCH_ASSOC);
       if($kayitvarmi['KayıtTarih']!=0){
        if(isset($_POST['update']))
            {
      
                    while ($row1 = mysqli_fetch_array($update)) :; 
                    $hareketdetay= $_POST['form']  ;    
                   
                     $query="UPDATE tbl_calismaprogrami SET HareketDetay = '".  $hareketdetay[$row1['calismaId']] ."', KayıtTarih='$datecozum' WHERE Id= '".$row1['calismaId']."'  ";
                  
                     if(mysqli_query($mysqli,$query))
                      { 
                    
                          echo '<script> swal({
                            title: "Çalişma Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("egitim.php");
                      
                        }); </script>';
                       
                        
                        
                      }  
                      continue;
                    endwhile;              
              }
            }
            else{
                echo '<script> swal({
                    title: "Eğitimde seçtiğiniz güne dair program yoktur!",
                    type: "success",
                    button: "Tamam",
                }).then(function() {
                    location.replace("calguncelonay.php");
                }); </script>';
            } 
               
 
        
?>
        <div style="width: 80%;  margin:auto; padding: 60px;    background-color:rgb(197, 195, 195) ;      border: 1px solid #ccc; ; margin-top:50px">    
        <H2 style="text-align: center; margin-bottom:20px;">Çalişma Programı Güncelle</H2>     
            <form class="" method="POST"  enctype="multipart/form-data">
                <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                <div  class="form-group row ">
                <select class="filecalisma" style="margin-right: 40px; width: 200px;" name="hareketad[<?php echo $row1['Hareketİsmi']; ?>]" id="ad">
                    <option class=""  value="" ><?php echo $row1['Hareketİsmi']; ?></option>
                  </select>
                  <select class="filecalisma" style=" width: 200px;" name="hareketad[<?php echo $row1['AltHareketAdi']; ?>]" id="ad">
                    <option class=""  value="" ><?php echo $row1['AltHareketAdi']; ?></option>
                  </select>

                  <input class="calismaeklerow" name="form[<?php echo $row1['calismaId']; ?>]" style="width: 350px;  margin:0 auto;" type="text"   placeholder="Tekrar" value="<?php echo $row1['HareketDetay']; ?>" required>           
                <img  style="width:80px; height:50px; " src="<?php echo 'data:image/jpeg;base64, ' . base64_encode($row1['name']) . '';?>" alt="">
               
               <div style="background-color:white; margin-left:25px" >
               <a style="margin:10px;"  href="calismasil.php?id=<?php echo $row1['calismaId'] ?>&Oid=<?php echo  base64_encode($ogrenciIdCozum)   ?>&Okid=<?php echo  base64_encode ($girisYapanId)    ?>"  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a>
               </div>
               
                <script type="text/javascript" src="icerik/script/sil.js"> </script>
                  <div  class="col-sm-10">                  
                  </div>
                </div>
                <hr>
                <?php endwhile;  ?>  
         
               
                
                <div class="form-group row">
                  <div class="col-sm-10"> 
 

                  <button type="submit" style="width: 40%; float: right; " name="update" id="update" class="calismaBtn">Çalışma Güncelle</button>
                
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

