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
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
$(window).load(function() {
  $("html, body").animate({ scrollTop: $(document).height() }, 0);
});
</script>


  <title>Anasayfa</title>


</head>
<body style="background-color:powderblue">  



<?php
    include './parcali/menu.php';
    include './function.php';
    include './dbconnect.php';
  
?>
<?php
        $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
        $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
      

       
        
        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' " );
        $satir = $sonucOgrenci->fetch_row();

        if($satir>0){
          $ogrenci = ogrenciinfo($girisYapanId,$girisYapanEmail);  
          $onlinekoc =  $_GET['Id'];
      
          $OgrenciIdcozum = base64_decode($onlinekoc);
          $onlinekocinfo= onlinekocCagirma($OgrenciIdcozum);
          if($_POST){
      
            if( strlen($_POST['message']) != 0){
                $mesaj = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci[0] ."' and  
                OnlineKocId ='".$OgrenciIdcozum ."' or OgrenciId='".$OgrenciIdcozum ."' and  OnlineKocId ='".$ogrenci[0] ."'")->rowcount();
               
                if($mesaj == 0){
                    $insert = $db->query("insert into tbl_mesaj(OgrenciId,OnlineKocId) values('".$ogrenci[0]."','$OgrenciIdcozum')");
                    $lastid= $db->lastInsertId();
                  
                    $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('$lastid','" . $_POST["message"]  . "',NOW(),'". $ogrenci[0] ."','P','P')");
                    if($icerikinsert){
                        
                      $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$lastid ."'");
                      header("Location:chat.php?Id=" . base64_encode($OgrenciIdcozum) . "");
                    }
                    else{
                        echo '<script> swal({
                            title: "Eklenemedii!",
                            button: "Tamam",
                        }); </script>';
                  }
    
                  }
                else{
                    $w = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci[0] ."' and  
                    OnlineKocId ='".$OgrenciIdcozum ."' or OgrenciId='".$OgrenciIdcozum ."' and  OnlineKocId ='".$ogrenci[0] ."'")->fetch();
                   
                  $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId, Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('".$w['Id']."','" . $_POST["message"]  . "',NOW(),'". $ogrenci[0] ."','P','P')");
                    if($icerikinsert){
                      
                      $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$w['Id'] ."'");
                      header("Location:chat.php?Id=" . base64_encode($OgrenciIdcozum) . "");
                    
                    }
                    else{
                      echo '<script> swal({
                        title: "Eklenemediki!",
                        button: "Tamam",
                      }); </script>';
                    }
                }
            }
            else{
              echo '<script> swal({
                  title: "Boş gecmeyiniz!",
                  button: "Tamam",
                }); </script>';
            }
        }
        $sayi=1;
        $sayi1=2;
         $w = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci[0] ."' and  
         OnlineKocId ='".$OgrenciIdcozum ."' or OgrenciId='".$OgrenciIdcozum ."' and  OnlineKocId ='".$ogrenci[0] ."'")->fetch(PDO :: FETCH_ASSOC);
    
    
        $all=$db->query("select * from tbl_mesajicerik where mesajId='".$w['Id']."' and OgrenciSil='P' order by Id asc")->fetchAll(PDO :: FETCH_ASSOC);
        foreach ($all as $key => $value) {
          $ogrenciinfo = ogrenciinfo($value['GonderenId'],$girisYapanEmail);
    
          if($sayi==1){
       
           echo'<div class="mesajbilgiler"  >
            <div class="mesajicerikbilgiler" >
           <div class="baslikkimle">
            <h1> ' . $onlinekocinfo['Adi'] .'  ' .   $onlinekocinfo['Soyadi']   .' </h1>
            </div>
           <form action="" method="POST">';
        
            $sayi=0;
          }
          if($value['GonderenId']=$ogrenciinfo['Id']){
            echo ' 
            <div class="chat-body">
            <div class="chat-content">
              <p style="border-bottom:1px solid grey;"> ' . $ogrenciinfo['Adi'] .'</p>
              
              <p>' .   $value['Icerik']   .' </p>
              <time class="chat-time" datetime="2015-07-01T11:37">'.   $value['Tarih']   .' am</time>
            </div>
          </div>
        
       ';
        }
        else{     
       echo ' <div class="chat chat-left">
          <div class="chat-body">
            <div class="chat-content">
            <p style="border-bottom:1px solid grey;"> ' . $onlinekocinfo['Adi'] . '</p>
            <p>' .   $value['Icerik']   .' </p>
            <time class="chat-time" datetime="2015-07-01T11:37">'.   $value['Tarih']   .' am</time>
            </div>
          </div>
        </div> 
      ';  
        }
        }
        if($sayi1==2){
            echo ' 
                    <textarea id="tekrarmesaj" name="message"   maxlength="255" ></textarea>
                    <button type="submit"  name="gonder" class="mesajGonderTekrar">Gönder</button>
            
            </form>
            </div>
            
            </div>
            </div>';
            echo '<div style=" width:100%;height:100px; "  >
            </div>';
            $sayi1=0;
    } 

                  
        }
        else{
          $onlinekoc = onlinekocinfo($girisYapanId,$girisYapanEmail);  
          $ogrenci =  $_GET['Id'];
          $OgrenciIdcozum = base64_decode($ogrenci);
        
          $ogrencinfo= ogrenciCagirma($OgrenciIdcozum);
          if($_POST){
           
            if( strlen($_POST['message']) != 0){
                $mesaj = $db->query("select * from tbl_mesaj where OgrenciId='".$OgrenciIdcozum ."' and  
                OnlineKocId ='".$onlinekoc[0] ."' or OgrenciId='".$onlinekoc[0] ."' and  OnlineKocId ='".$OgrenciIdcozum."'")->rowcount();
               
                if($mesaj == 0){
                    $insert = $db->query("insert into tbl_mesaj(OgrenciId,OnlineKocId) values('.$OgrenciIdcozum.','".$onlinekoc[0]."')");
                    $lastid= $db->lastInsertId();
                  
                    $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('$lastid','" . $_POST["message"]  . "',NOW(),'". $onlinekoc[0] ."','P','P')");
                    if($icerikinsert){
                        
                      $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$lastid ."'");
                      header("Location:chat.php?Id=" . base64_encode($OgrenciIdcozum) . "");
                    }
                    else{
                        echo '<script> swal({
                            title: "Eklenemedii!",
                            button: "Tamam",
                        }); </script>';
                  }
    
                  }
                else{
                    $w = $db->query("select * from tbl_mesaj where OgrenciId='".$OgrenciIdcozum ."' and  
                    OnlineKocId ='".$onlinekoc[0] ."' or OgrenciId='".$onlinekoc[0] ."' and  OnlineKocId ='".$OgrenciIdcozum ."'")->fetch();
                   
                  $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId, Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('".$w['Id']."','" . $_POST["message"]  . "',NOW(),'". $onlinekoc[0] ."','P','P')");
                    if($icerikinsert){
                      
                      $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$w['Id'] ."'");
                      header("Location:chat.php?Id=" . base64_encode($OgrenciIdcozum) . "");
        
                    }
                    else{
                      echo '<script> swal({
                        title: "Eklenemediki!",
                        button: "Tamam",
                      }); </script>';
                    }
                }
            }
            else{
              echo '<script> swal({
                  title: "Boş gecmeyiniz!",
                  button: "Tamam",
                }); </script>';
            }
        }

        $sayi=1;
        $sayi1=2;
         $w = $db->query("select * from tbl_mesaj where OgrenciId='".$OgrenciIdcozum ."' and  
         OnlineKocId ='".$onlinekoc[0] ."' or OgrenciId='".$onlinekoc[0] ."' and  OnlineKocId ='".$OgrenciIdcozum ."'")->fetch(PDO :: FETCH_ASSOC);
    
    
        $all=$db->query("select * from tbl_mesajicerik where mesajId='".$w['Id']."' and OnlineKocSil='P' order by Id asc")->fetchAll(PDO :: FETCH_ASSOC);
        foreach ($all as $key => $value) {
          $onlinekocinfo = onlinekocinfo($value['GonderenId'],$girisYapanEmail);
         // $ogrenciinfo = ogrenciinfo($value['GonderenId'],$girisYapanEmail);
    
          if($sayi==1){
       
           echo'<div class="mesajbilgiler" >
            <div class="mesajicerikbilgiler" >
           <div class="baslikkimle">
            <h1> ' . $ogrencinfo['Adi'] .'  ' .   $ogrencinfo['Soyadi']   .' </h1>
            </div>
           <form action="" method="POST">';
        
            $sayi=0;
          }
          if($value['GonderenId']=$onlinekocinfo['Id']){
            echo ' 
            <div class="chat-body">
            <div class="chat-content">
              <p style="border-bottom:1px solid grey;"> ' . $onlinekocinfo['Adi'] .'</p>
              
              <p>' .   $value['Icerik']   .' </p>
              <time class="chat-time" datetime="2015-07-01T11:37">'.   $value['Tarih']   .' am</time>
            </div>
          </div>
        
       ';
        }
        else{     
       echo ' <div class="chat chat-left">
          <div class="chat-body">
            <div class="chat-content">
            <p style="border-bottom:1px solid grey;"> ' . $ogrencinfo['Adi'] . '</p>
            <p>' .   $value['Icerik']   .' </p>
            <time class="chat-time" datetime="2015-07-01T11:37">'.   $value['Tarih']   .' am</time>
            </div>
          </div>
        </div> 
      ';  
        }
        }
        if($sayi1==2){
            echo ' 
                    <textarea id="tekrarmesaj" name="message"   maxlength="255" ></textarea>
                    <button type="submit"  name="gonder" class="mesajGonderTekrar">Gönder</button>
            
            </form>
            </div>
            
            </div>
            </div>';
            echo '<div style=" width:100%;height:100px; "  >
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

