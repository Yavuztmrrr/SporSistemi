<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icerik/css/stil.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src= "https://code.jquery.com/jquery-3.1.1.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body  style="background-color:powderblue">
<?php
 //<a  href="#"  style=" width: 100%;"   class="mesajlistesil" class="mesajGonder" >  <button style="background-color:red;"  type="submit"  class="mesajGonder">Alt Hareket Ekle</button></a> 
      include './parcali/adminmenu.php';
      include './dbconnect.php';
      include './islem.php';
?>
<?php
       $liste = "SELECT  * FROM tbl_brans";
       $result = mysqli_query($mysqli, $liste);

       if (count($_POST) > 0) {
        
           
           
            if(isset($_POST['insert']))
            {
                $file= addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
            $query="INSERT INTO tbl_brans ( name,Adi,Aciklama,Durum)
         
            values ('$file','" .  $_POST["bransAdi"] . "','" .  $_POST["bransAciklama"] . "','P') ";
              
              if(mysqli_query($mysqli,$query))
              {
                echo '<script> swal({
                    title: "Branş başarılı Onaya Düşmüştür",
                    button: "Tamam",
                }); </script>';
              }
            }     
           
        } 
?>

    <div style="height:700px;  " class="mesajContent " >
        <p class="mesajBaslik">Branş Ekleme</p>
        <div class="mesajIcerik">
        <form action="" method="POST"  enctype="multipart/form-data">
                <label class="mesajLabel"> Branş İsmi</label>
                <input class="mesajInput" type="text" name="bransAdi" required/>
                  <br>  
                <label class="mesajLabel">Brans Açiklama</label>
                <textarea id="message" name="bransAciklama"   maxlength="100" required></textarea>
                <label class="mesajLabel">Branş Resim</label>
                <input class="mesajInput" type="file" name="image" id="image"/>
                <button type="submit" id="insert"  name="insert" class="mesajGonder">Ekle</button>

        </form>
        </div>
        </div>
        <script type="text/javascript" src="icerik/script/resimkontrol.js"> </script>
        
        
        <?php    
          $list = $db->query("select * from tbl_brans where Durum='P' ")->fetchAll(PDO :: FETCH_ASSOC);
              if(isset($_POST['update'])){
                $query= "UPDATE tbl_brans set Durum = 'A'  ";
               
                if(mysqli_query($mysqli,$query))
                      { 
                    
                          echo '<script> 
                          swal({
                            title: "Branş  Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("bransekle.php");
                        });
                        </script>';
                      }   
                      else{
                        echo '<script> swal({
                            title: "Branş  Onayı  Başarısızdır!",
                            button: "Tamam",
                        }); </script>';
                      }        
                    
              }
              
           ?>
    
<div style="height:auto; " class="mesajContent " > 
    <p class="mesajBaslik">Branş Onayı</p>   
               <form class="" method="POST"  enctype="multipart/form-data">
               <?php
               $sayi=1;
               $sayi1 = 1;
               echo '
                <table  class="table" style="background-color:white;margin:auto ;">
                <thead   class="thead-light">
                  <tr>
                    <th  scope="col">Id</th>   
                    <th  scope="col">Haber Resmi</th>  
                    <th  scope="col">Brans İsmi</th> 
                   
                    <th  scope="col">Brans Aciklama</th>           

                     
                    <th  scope="col"></th>

          
                  </tr>
                </thead>
             
                <tbody>
                
                ';
            foreach ($list as $key => $value) {
                  echo '
                  </thead>
                  <tbody   >
                
                  <tr >
          
                  <th  scope="row">'.$value['Id'].' </th>
                  <th  scope="row">  <img class="image" style="width: 80px;  height: 70px; " src="data:image/jpeg;base64, ' . base64_encode($value['name']) .'"/> </th>
                  <th  scope="row">'.$value['Adi'].' </th>
                  ';
                  $uzunMetin=$value['Aciklama'];      
                  echo'
               
                  <td  scope="row" >'.substr($uzunMetin, 0, 18).'...</td>
                  <td  scope="row" ><a href="branssil.php?id='.$value['Id'].'"  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a> </td>
                    <script type="text/javascript" src="icerik/script/sil.js"> </script>
                
                </tr>
                <br>
                  ';

           }
               
            ?>
        
</tbody>
</table>
</div>

<button type="submit" style="width: 40%; margin-left:30%; " name="update" id="update" class="hareketOnay">Brans Ekle</button>     
<?php
    include './parcali/footer.php';
?>
</body>
</html>