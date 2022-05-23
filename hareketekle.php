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
        if(isset($_POST['ekle']))
        {     

            $query="INSERT INTO tbl_hareketisimleri ( BransId, Adi,Durumm)
            values ('" .  $_POST["bransId"] . "','" .  $_POST["HareketAdi"] . "','P') ";
              if(mysqli_query($mysqli,$query))
                  { 
                
                      echo '<script> swal({
                        title: "Hareket başarılı şekilde eklenmiştir!",
                        button: "Tamam",
                    }); </script>';
                  }   
                  else{
                    echo '<script> swal({
                        title: "Hareket eklenememiştir!",
                        button: "Tamam",
                    }); </script>';
                  }                
          } 
    }
?>
<?php
    
?>

    <div style="height:500px;  " class="mesajContent " >
        <p class="mesajBaslik">Hareket Ekleme</p>
        <div class="mesajIcerik">
        <form action="" method="POST">
                <label class="mesajLabel">Branş  İsmi</label>
                <select class="filecalisma" id="hareket" style="  width: 100%; height:30px" name="bransId" id="ad">
                  <?php while ($row1 = mysqli_fetch_array($result)) :; ?>
                    <option class=""  value="<?php echo  $row1["Id"]; ?> "><?php echo $row1['Adi']; ?></option>
                    <?php endwhile;  ?>  
                  </select>
                  <br>
                  <br>
                <label class="mesajLabel">Hareket Adi</label>
                <input class="mesajInput" type="text" name="HareketAdi" required/>
                <button type="submit"  name="ekle" class="mesajGonder">Ekle</button>
              
               

        </form>
        </div>
        </div>

        <?php
            
            $list = $db->query("select * from tbl_hareketisimleri where Durumm='P' ")->fetchAll(PDO :: FETCH_ASSOC);
           
          
              if(isset($_POST['update'])){
                $query= "UPDATE tbl_hareketisimleri set Durumm = 'A'  ";
               
                if(mysqli_query($mysqli,$query))
                      { 
                    
                          echo '<script> 
                          swal({
                            title: "Hareket Onayı  Başarılıdır!",
                            type: "success",
                            button: "Tamam",
                        }).then(function() {
                            location.replace("hareketekle.php");
                        });
                        </script>';
                      }   
                      else{
                        echo '<script> swal({
                            title: "Hareket Onayı  Başarısızdır!",
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
                      <th  scope="col">Brans Adi</th>           
                      <th style="" scope="col">Hareket Adi</th>       
                      <th style="" scope="col"></th>
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
                  <td  >'.$value['Adi'].'</td>
                  <td ><a href="hareketsil.php?id='.$value['Id'].'"  onclick=" return uyari();"   class="calismasil" ><i class="fa fa-trash iconrenk"></i></a> </td>
                    <script type="text/javascript" src="icerik/script/sil.js"> </script>
                
                </tr>
                <br>
                  ';

           }
               
            ?>
        
</tbody>
</table>
</div>

<button type="submit" style="width: 40%; margin-left:30%; " name="update" id="update" class="hareketOnay">Hareket Ekle</button>     
<?php
    include './parcali/footer.php';
?>
</body>
</html>