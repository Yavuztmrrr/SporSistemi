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
    <title>Alt Hareket Ekle</title>
</head>
<body  style="background-color:powderblue">
<?php
 
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
            $query="INSERT INTO tbl_althareketisimleri ( name,hareketId,Adi,Durum)
         
            values ('$file','" .  $_POST["hareketId"] . "','" .  $_POST["altHareketAdi"] . "','P') ";
              
              if(mysqli_query($mysqli,$query))
              {
                echo '<script> swal({
                    title: "Hareket başarılı Onaya Düşmüştür",
                    button: "Tamam",
                }); </script>';
              }
            }     
           
        } 
       
   




      
  
?>
<?php
    
?>

    <div style="height:680px;  " class="mesajContent " >
        <p class="mesajBaslik">Alt Hareket Ekleme</p>
        <div class="mesajIcerik">
        <form action="" method="POST"  enctype="multipart/form-data">
                 <label class="mesajLabel">Branş  Dali</label>
                 <select class="filecalisma" id="brans" style="  width: 100%; height:30px" name="bransId" id="ad">
                  <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                    <option class=""  value="<?php echo  $row1["Id"]; ?> "><?php echo $row1['Adi']; ?></option>
                    <?php endwhile;  ?>  
                  </select>
                  <br>
                  <br>
                <label class="mesajLabel">Hareket İsmi</label>
                <select class="filecalisma" id="hareketadi" style="  width: 100%; height:30px" name="hareketId" id="ad">
                <option class=""  value=" ">Brans Seçiniz</option> 
                  </select>
                  <br>
                  <br>
                <label class="mesajLabel">Alt Hareket Adi</label>
                <input class="mesajInput" type="text" name="altHareketAdi" required/>
                <label class="mesajLabel">Resim</label>


                <input class="mesajInput" type="file" name="image" id="image"/>
                <button type="submit" id="insert"  name="insert" class="mesajGonder">Ekle</button>
        </form>
        </div>
        </div>
        <script type="text/javascript" src="icerik/script/resimkontrol.js"> </script>
        <script type="text/javascript">
                    $(document).ready(function(){
                      $("#brans").change(function(){
                        var hareketid = $(this).val(); 
                        $.ajax({
                          type : "POST",
                          url : "hareketgetir.php",
                          data : {"brans":hareketid},
                          success : function(e)
                          {
                           
                            $("#hareketadi").html(e);
                           
                          }
                        });
                        
                      })
                    });
                  </script>
        
        <?php
            
            $list = $db->query("select * from tbl_althareketisimleri where Durum='P' ")->fetchAll(PDO :: FETCH_ASSOC);
           
          
              if(isset($_POST['update'])){
                $query= "UPDATE tbl_althareketisimleri set Durum = 'A'  ";
               
                if(mysqli_query($mysqli,$query))
                      { 
                    
                          echo '<script> 
                          swal({
                            title: "Alt hareket  Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("althareketekle.php");
                        });
                        </script>';
                      }   
                      else{
                        echo '<script> swal({
                            title: "Alt hareket  Onay  Başarısızdır!",
                            button: "Tamam",
                        }); </script>';
                      }        
                    
              }
              
           ?>
    
<div style="height:auto ;" class="mesajContent " > 
    <p class="mesajBaslik">Hareket Ekleme Onayı</p>   
               <form class="" method="POST"  enctype="multipart/form-data">
               <?php
               $sayi=1;
               $sayi1 = 1;
               echo '
                <table  class="table" style="background-color:white;margin:auto ;">
                <thead   class="thead-light">
                  <tr>
                    <th  scope="col">Id</th>   
                    <th  scope="col">Alt Hareket Resmi</th>  
                    <th  scope="col">Hareket Adi</th>           
                    <th  scope="col">Alt Hareket Adi</th>       
                    <th  scope="col"></th>

          
                  </tr>
                </thead>
             
                <tbody>
                
                ';
            foreach ($list as $key => $value) {
                $bransId = $db->query("SELECT  * FROM tbl_hareketisimleri where Id ='".$value['hareketId']."' ")->fetch(PDO :: FETCH_ASSOC);
        
    
                
                  echo '
                  </thead>
                  <tbody   >
                
                  <tr >
          
                  <th  scope="row">'.$value['Id'].' </th>
                  <th  scope="row">  <img class="image" style="width: 80px;  height: 70px; " src="data:image/jpeg;base64, ' . base64_encode($value['name']) .'"/> </th>
                  ';
                
                  echo'
                  <th  scope="row">'.$bransId['Adi'].' </th>
                  ';
        
                  echo'
               
                  <td  >'.$value['Adi'].'</td>
                  <td ><a href="althareketsil.php?id='.$value['Id'].'"  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a> </td>
                    <script type="text/javascript" src="icerik/script/sil.js"> </script>
                
                </tr>
                <br>
                  ';

           }
               
            ?>
        
</tbody>
</table>
</div>

<button type="submit" style="width: 40%; margin-left:30%; " name="update" id="update" class="hareketOnay">Alt Hareket Ekle</button>     
<?php
    include './parcali/footer.php';
?>
</body>
</html>