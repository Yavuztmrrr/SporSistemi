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
            $query="INSERT INTO tbl_onlinekochaber ( name,bransId,HaberBaslik,HaberKonu,Durum)
         
            values ('$file','" .  $_POST["bransId"] . "','" .  $_POST["haberbaslik"] . "','" .  $_POST["haberkonu"] . "','P') ";
              
              if(mysqli_query($mysqli,$query))
              {
                echo '<script> swal({
                    title: "Haber başarılı Onaya Düşmüştür",
                    button: "Tamam",
                }); </script>';
              }
            }     
           
        } 
       
   




      
  
?>
<?php
    
?>

    <div style="height:700px;  " class="mesajContent " >
        <p class="mesajBaslik">Online Koç Haber Ekleme</p>
        <div class="mesajIcerik">
        <form action="" method="POST"  enctype="multipart/form-data">
                <label class="mesajLabel"> Haber Branş İsmi</label>
                <select class="filecalisma" id="hareket" style="  width: 100%; height:30px" name="bransId" id="ad">
                  <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                    <option class=""  value="<?php echo  $row1["Id"]; ?> "><?php echo $row1['Adi']; ?></option>
                    <?php endwhile;  ?>  
                  </select>
                  <br>
                  <br>
                <label class="mesajLabel">Haber Baslik</label>
                <input class="mesajInput" type="text" name="haberbaslik" required/>
                <label class="mesajLabel">Haber Konu</label>
                <textarea id="message" name="haberkonu"   maxlength="100" required></textarea>
                <label class="mesajLabel">Haber Resim</label>
                <input class="mesajInput" type="file" name="image" id="image"/>
                <button type="submit" id="insert"  name="insert" class="mesajGonder">Ekle</button>

        </form>
        </div>
        </div>
        <script type="text/javascript" src="icerik/script/resimkontrol.js"> </script>
        
        
        <?php
            
            $list = $db->query("select * from tbl_onlinekochaber where Durum='P' ")->fetchAll(PDO :: FETCH_ASSOC);
           
          
              if(isset($_POST['update'])){
                $query= "UPDATE tbl_onlinekochaber set Durum = 'A'  ";
               
                if(mysqli_query($mysqli,$query))
                      { 
                    
                          echo '<script> 
                          swal({
                            title: "Haber  Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("haberekle.php");
                        });
                        </script>';
                      }   
                      else{
                        echo '<script> swal({
                            title: "Haber  Onay  Başarısızdır!",
                            button: "Tamam",
                        }); </script>';
                      }        
                    
              }
              
           ?>
    
<div style="height:auto; " class="mesajContent " > 
    <p class="mesajBaslik">Haber Onayı</p>   
               <form class="" method="POST"  enctype="multipart/form-data">
               <?php
               $sayi=1;
               $sayi1 = 1;
               echo '
                <table  class="table" style="background-color:white;margin:auto ;">
                <thead   class="thead-light">
                  <tr>
                    <th  scope="col">Id</th>   
                    <th  scope="col">Haber Branşi</th> 
                    <th  scope="col">Haber Resmi</th>  
                    <th  scope="col">Haber Baslik</th>           
                    <th  scope="col">Haber Konu</th>   
                     
                    <th  scope="col"></th>

          
                  </tr>
                </thead>
             
                <tbody>
                
                ';
            foreach ($list as $key => $value) {
                $bransId = $db->query("SELECT  * FROM tbl_brans where Id ='".$value['BransId']."' ")->fetch(PDO :: FETCH_ASSOC);
        
    
                
                  echo '
                  </thead>
                  <tbody   >
                
                  <tr >
          
                  <th  scope="row">'.$value['Id'].' </th>
                  <th  scope="row">'.$bransId['Adi'].' </th>
                
                  <th  scope="row">  <img class="image" style="width: 80px;  height: 70px; " src="data:image/jpeg;base64, ' . base64_encode($value['name']) .'"/> </th>
                  ';
                  $uzunMetin=$value['HaberKonu'];
                  echo'
                  <th  scope="row">'.$value['HaberBaslik'].' </th>
                  ';
        
                  echo'
               
                  <td  scope="row" >'.substr($uzunMetin, 0, 18).'...</td>
                  <td  scope="row" ><a href="habersil.php?id='.$value['Id'].'"  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a> </td>
                    <script type="text/javascript" src="icerik/script/sil.js"> </script>
                
                </tr>
                <br>
                  ';

           }
               
            ?>
        
</tbody>
</table>
</div>

<button type="submit" style="width: 40%; margin-left:30%; " name="update" id="update" class="hareketOnay">Haber Ekle</button>     
<?php
    include './parcali/footer.php';
?>
</body>
</html>