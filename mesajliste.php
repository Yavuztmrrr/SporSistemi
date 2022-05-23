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

  <title>Mesaj Liste</title>
</head>
<body style="background-color:powderblue";>  
<?php
 include './parcali/menu.php';
?>   



<?php

    include './function.php';
    include './dbconnect.php';
    $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
    $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
?>
<nav  style="width:70%; margin:0 auto; padding-top:32px " aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
   <li class="breadcrumb-item"><H5>Mesajlarım ve Odemeler<H5></li>      
   <a href="mesaj.php" style=" margin-left:60%;  "><button class="kayitButon"  type="button" >Mesaj Gönder</button></a>       
    </ol>
    </nav> 
<?php
    echo'';      
        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' " );
        $satir = $sonucOgrenci->fetch_row();
        if($satir>0){
          $sayi=1;
          $sayi1=1;
          //odeme formu onayı
                  $liste = "SELECT * FROM tbl_egitimalanogrenciler where OgrenciId=$girisYapanId and Durum = 'A' ";
                    $result = mysqli_query($mysqli, $liste); 
                    while ($row1 = mysqli_fetch_array($result)):;
                  $egitim = $db->query("select * from tbl_Onlinekoc where Id='".$row1[2]."' ")->fetch(PDO :: FETCH_ASSOC);
                    if( $sayi==1){
                      echo'
                    <div class="mesajlistele"  class="">
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
                      <a onclick="return checkDelete()"  href="odeme.php?Eid=' . base64_encode($row1[0])  . '&manys=' . base64_encode ($egitim['EgitimFiyati'])  . '"    class="mesajyollalink" > <button class="onayla">Ödeme</button>  </a>
                      <a  href="egitimiptal.php?islemEAO=' . base64_encode($row1[0] ) .'" onclick=" return iptal();"   class="mesajyollalink" >  <button class="reddet">Reddet</button>  </a> 
                      <script type="text/javascript" src="icerik/script/onayiptal.js"> </script>
                      <span style="float:left; color: blue;">'.$row1[3].'</span>
                      <br>
                       
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
                  
                    $sayi1=0;
                  }         
                  //mesaj listesi
          $ogrenci=ogrenciinfo($girisYapanId,$girisYapanEmail); ;
  
          $sayi1=1;
          $sayi=1;
        
          $list = $db->query("select DISTINCT  m.Id as Mesaj, m.OnlineKocId from tbl_mesaj m inner join tbl_mesajicerik mi on m.Id=mi.MesajId WHERE m.OgrenciId='". $ogrenci[0]."' and mi.OgrenciSil='P'  order by m.UpdateTarih desc    ")->fetchAll(PDO :: FETCH_ASSOC);
          $listodeme = $db->query("select * from tbl_egitimalanogrenciler where OgrenciId='". $girisYapanId."' and Durum = 'A'   ")->fetchAll(PDO :: FETCH_ASSOC);

          if($list==null && $listodeme==null ){
                echo '<script> swal({
                  title: "Mesajınız bulunmamaktadır veya Onayınız yoktur!",
                  type: "success",
                  button: "Tamam",
              }).then(function() {
                  location.replace("mesaj.php");
              }); </script>';
              }
            else{

            
                foreach ($list as $key => $value) {
                
                      $useId = $value['OnlineKocId'];
                      $liste = "SELECT * FROM tbl_OnlineKoc where Id=$useId ";
                  
                      $result = mysqli_query($mysqli, $liste); 
                
                  
                  $sonmesaj = $db->query("select * from tbl_mesajIcerik where mesajId='". $value['Mesaj']."' and OgrenciSil='P' order by Id desc limit 0,1 ")->fetch(PDO :: FETCH_ASSOC);
                // 
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
                while ($row1 = mysqli_fetch_array($result)):;

                echo '
                
                <hr>
                <li> 
                    
                
                <a href="chat.php?Id='. base64_encode($useId) .'" class="mesajyollalink" >
                  <div class="message-avatar">
                
                  </div>
                  <div class="message-body">
                    <div class="message-body-heading">
                    <span style="float:right;">'.$sonmesaj['Tarih'].'</span>
                    
                      <h5>Konuşulan Kişi : '.$row1['Adi'].' '.$row1['Soyadi'].'<span class="pending"></span></h5>   
                    
                    </div>
                    <a  href="mesajsilogrenci.php?id='.$value['Mesaj'].'"  onclick=" return uyari();"   class="mesajlistesil" ><button class="butonicon"  ><i class="fa fa-trash"></i></button></a>  
                    <script type="text/javascript" src="icerik/script/silme.js"> </script>
                    <p>Son Mesaj : '.$sonmesaj['Icerik'].'</p>
                  
                  </div>
                </a>
                
              </li> 
                ';
              ?>
              <?php
                endwhile;
                }
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
        }
        else{
          $onlinekoc=onlinekocinfo($girisYapanId,$girisYapanEmail); ;
          $sayi1=1;
          $sayi=1;
          $list = $db->query("select DISTINCT  m.Id as Mesaj, m.OgrenciId from tbl_mesaj m inner join tbl_mesajicerik mi on m.Id=mi.MesajId WHERE m.OnlineKocId='". $onlinekoc[0]."' and mi.OnlineKocSil='P'  order by m.UpdateTarih desc    ")->fetchAll(PDO :: FETCH_ASSOC);
         // $list = $db->query("select * from tbl_mesaj where OnlineKocId='". $onlinekoc[0]."' order by UpdateTarih desc   ")->fetchAll(PDO :: FETCH_ASSOC);
          if($list==null){
            echo '<script> swal({
              title: "Mesajınız bulunmamaktadır!",
              type: "success",
              button: "Tamam",
          }).then(function() {
              location.replace("mesaj.php");
          }); </script>';
          }  
          else{
            foreach ($list as $key => $value) {
            
                  $useId = $value['OgrenciId'];
                  $liste = "SELECT * FROM tbl_Ogrenci where Id=$useId ";
              
              $result = mysqli_query($mysqli, $liste); 
            //$onlinekoc = onlinekocinfo($value['OgrenciId'],$girisYapanEmail);
              //$onlineinfo = onlinekocCagirma($onlinekocId);
              $sonmesaj = $db->query("select * from tbl_mesajIcerik where mesajId='". $value['Mesaj']."' and OnlineKocSil='P' order by Id desc limit 0,1 ")->fetch(PDO :: FETCH_ASSOC);
     
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
            while ($row1 = mysqli_fetch_array($result)):;
    
            echo '
            
            <hr>
            <li>  
           
      
            <a href="chat.php?Id='. base64_encode($useId) .'" class="mesajyollalink" >
              <div class="message-avatar">
        
              </div>
              <div class="message-body">
                <div class="message-body-heading">
                <span style="float:right;">'.$sonmesaj['Tarih'].'</span>
                  <h5>Konuşulan Kişi : '.$row1['Adi'].' '.$row1['Soyadi'].'<span class="pending"></span></h5>   
                </div>
              
                <a  href="mesajsilonlinekoc.php?id='.$value['Mesaj'].'"  onclick=" return uyari();"   class="mesajlistesil" ><button class="butonicon"  ><i class="fa fa-trash"></i></button></a>  
                <script type="text/javascript" src="icerik/script/silme.js"> </script>
                <p>Son Mesaj : '.$sonmesaj['Icerik'].'</p>
              </div>
          
              
          </li> 
            ';
           ?>
          <?php
            endwhile;
            }
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
           
        }   
?>


<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>
</body>
</html>

