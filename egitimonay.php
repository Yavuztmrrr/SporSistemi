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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

  <title>MesajListe</title>
</head>
<body style="background-color:powderblue";>  
<?php
 include './parcali/menu.php';
?>   
<nav  style="width:70%; margin:0 auto; padding-top:32px " aria-label="breadcrumb" class="main-breadcrumb">
       <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Onay bekleyen ogrenciler</a></li>             
       </ol>
 </nav> 


<?php

    include './function.php';
    include './dbconnect.php';
?>

<?php
        $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
        $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
    
          $sayi=1;
          $sayi1=1;
          $list = $db->query("select * from tbl_egitimalanogrenciler where OnlineKocId='". $girisYapanId."' and Durum = 'P'   ")->fetchAll(PDO :: FETCH_ASSOC);
   
          if($list==null){
            echo '<script> swal({
              title: "Yeni istek bulunmamaktadır!",
              type: "success",
              button: "Tamam",
          }).then(function() {
              location.replace("anasayfa.php");
          }); </script>';
          }  
          else{
          
            
                 
            $liste = "SELECT * FROM tbl_egitimalanogrenciler where OnlineKocId=$girisYapanId and Durum = 'P' ";
              
              $result = mysqli_query($mysqli, $liste); 
              while ($row1 = mysqli_fetch_array($result)):;

             $egitim = $db->query("select * from tbl_Ogrenci where Id='".$row1[1]."' ")->fetch(PDO :: FETCH_ASSOC);
              
              if( $sayi==1){
                echo'
              <div class="mesajlistele"  style=""class="">
                <div style=" width: 100%; margin:0 auto;" class="row">
                <div class="col-md-11">
                  <div class="chat_container">
                    <div class="job-box">
                      <div class="job-box-filter">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
      
                        </div>
                
                      </div>
                    </div>
                    <div class="inbox-message">
                    
                    <ul>  
                    <div ></div>    
            
            ';
              $sayi=0;
    
            }

            echo '
            
            <hr>
            <li>   
            '; 
            echo '<div class="message-body">
                <div class="message-body-heading">
             
              
                <a   href="onlinekoconayla.php?islemO=' . base64_encode($row1[1] ) . '&islemOk=' . base64_encode($row1[2])  . '"    class="mesajyollalink" >  <button class="onayla" >Onayla</button>  </a>
            
                <a    href="egitimiptal.php?islemEAO=' . base64_encode($row1[0] ) .'"  onclick=" return iptal();"   class="mesajyollalink" >  <button class="reddet" >Reddet</button>  </a> 
                <script type="text/javascript" src="icerik/script/onayiptal.js"> </script>
                <span style="float:left; color: blue;">'.$row1[3].'</span>
                <br>
                  <h5>Spor Sistemi Ogrenci Eğitime katılma talebi</h5>   
                </div>
                <p>Adi Soyadi : '.$egitim['Adi'].' '.$egitim['Soyadi'].' 
                <br>Email : '.$egitim['Email'].'</p>
                <p> </p>
              </div>
          
          </li> 
          <hr>
            ';
           
   
           ?>
          <?php
            endwhile;
       
            }
         
            if($sayi1==1){
              echo'
              </ul>
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
              ';
              echo '<div style=" width:100%;height:500px; "  >
              </div>';
              $sayi1=0;
             }         
?>
</body>
</html>
<a class="dileksikayet" > Dilek Ve Sikayet</a>
<?php

    include './parcali/footer.php';
?>
</body>
</html>
