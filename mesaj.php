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

  <title>Mesaj Gonder</title>


</head>
<body style="background-color:powderblue";>  



<?php
    include './parcali/menu.php';
    
    include './function.php';
    include './dbconnect.php';

    $girisYapanId=$_SESSION["sporsistemi"][0]['Id'];
    $girisYapanEmail=$_SESSION["sporsistemi"][0]['Email'];
?>

<?php
        

        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' " );
        $satir = $sonucOgrenci->fetch_row();
        if($satir>0){
            $ogrenci = ogrenciinfo($girisYapanId,$girisYapanEmail); 
      if($_POST){
        $onlinekoc =  $_POST['gonderilecekKisi'];
       
        if(strlen($_POST['gonderilecekKisi']) != 0 &&  strlen($_POST['message']) != 0){
            $mesaj = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci[0] ."' and  
            OnlineKocId ='".$onlinekoc ."' or OgrenciId='".$onlinekoc ."' and  OnlineKocId ='".$ogrenci[0] ."'")->rowcount();
           
            if($mesaj == 0){
                $insert = $db->query("insert into tbl_mesaj(OgrenciId,OnlineKocId) values('".$ogrenci[0]."','$onlinekoc')");
                $lastid= $db->lastInsertId();
              
                $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('$lastid','" . $_POST["message"]  . "',NOW(),'". $ogrenci[0] ."','P','P')");
                if($icerikinsert){       
                    $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$lastid ."'");        
                    header("Location:chat.php?Id= " . base64_encode($onlinekoc) . "");

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
                OnlineKocId ='".$onlinekoc ."' or OgrenciId='".$onlinekoc ."' and  OnlineKocId ='".$ogrenci[0] ."'")->fetch();
  
              $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('".$w['Id']."','" . $_POST["message"]  . "', NOW() ,'". $ogrenci[0] ."','P','P')");
                if($icerikinsert){
                    $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$w['Id'] ."'");
                
                    header("Location:chat.php?Id= " . base64_encode($onlinekoc) . "");
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

    $onlinekoclar = "SELECT * FROM tbl_onlinekoc";
    $result = mysqli_query($mysqli, $onlinekoclar);
       
    echo '
    <div class="mesajContent" >
    <p class="mesajBaslik">Mesajlarınızı Gönderin</p>
    <div class="mesajIcerik">
    <form action="" method="POST">
            <label class="mesajLabel">Gönderilecek Kişi</label>

            <input class="mesajInput" list="onlinekoc" type="text" name="gonderilecekKisi" placeholder="Email veya Adi ile arayınız" />
          
            <datalist   id="onlinekoc">';
            while ($row1 = mysqli_fetch_array($result)) :; 
            echo'
                <option  value= "'. $row1[0] .'-'. $row1[1] .' '. $row1[2] .'" > '. $row1[3] .'  </option>
                ';
            endwhile; 
             echo'
             
            </datalist>
            
       
            <label  class="mesajLabel">İçerik</label>
            <br>
            <textarea id="message" name="message"   maxlength="100" ></textarea>
            <button type="submit"  name="gonder" class="mesajGonder">Gönder</button>
    </form>
    </div>
</div>';
    

        }
        else{
            $onlinekoc = onlinekocinfo($girisYapanId,$girisYapanEmail); 
            if($_POST){
              $ogrenci =  $_POST['gonderilecekKisi'];
              if(strlen($_POST['gonderilecekKisi']) != 0  &&  strlen($_POST['message']) != 0){

                $mesaj = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci ."' and  
                OnlineKocId ='".$onlinekoc[0] ."' or OgrenciId='".$onlinekoc[0] ."' and  OnlineKocId ='".$ogrenci ."'")->rowcount();
               
                if($mesaj == 0){
                    $insert = $db->query("insert into tbl_mesaj(OgrenciId,OnlineKocId) values('$ogrenci','".$onlinekoc[0]."')");
                    $lastid= $db->lastInsertId();
                  
                    $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('$lastid','" . $_POST["message"]  . "',NOW(),'". $onlinekoc[0] ."','P','P')");
                    if($icerikinsert){       
                        $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$lastid ."'");
                        header("Location:chat.php?Id= " . base64_encode($ogrenci) . "");        
                       
    
                    }
                    else{
                        echo '<script> swal({
                            title: "Eklenemedii!",
                            button: "Tamam",
                        }); </script>';
                  }
                
                  }
                else{
                    $w = $db->query("select * from tbl_mesaj where OgrenciId='".$ogrenci ."' and  
                    OnlineKocId ='".$onlinekoc[0] ."' or OgrenciId='".$onlinekoc[0] ."' and  OnlineKocId ='".$ogrenci ."'")->fetch();
      
                  $icerikinsert = $db->query("insert into tbl_mesajicerik(MesajId,  Icerik, Tarih,GonderenId,OgrenciSil,OnlineKocSil)values('".$w['Id']."','" . $_POST["message"]  . "', NOW() ,'". $onlinekoc[0] ."','P','P')");
                    if($icerikinsert){
                        $db->query("update tbl_mesaj set UpdateTarih=NOW() where Id='".$w['Id'] ."'");
                        header("Location:chat.php?Id= " . base64_encode($ogrenci) . "");
   
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
                }); </script>  ';
            }


            }
            $ogrenciler = "SELECT * FROM tbl_ogrenci";
            $result = mysqli_query($mysqli, $ogrenciler);
             
           
            echo '
            <div class="mesajContent" >
            <p class="mesajBaslik">Mesajlarınızı Gönderin</p>
            <div class="mesajIcerik">
            <form action="" method="POST">
                    <label class="mesajLabel">Gönderilecek Kişi</label>
        
                    <input class="mesajInput" list="onlinekoc"  type="text" name="gonderilecekKisi" placeholder="Email veya Adi ile arayınız" />
                  
                    <datalist id="onlinekoc">';
                    while ($row1 = mysqli_fetch_array($result)) :; 
                    echo'
                        <option value= "'. $row1[0] .'-'. $row1[1] .' '. $row1[2] .'" > '. $row1[3] .' </option>
                        ';
                    endwhile; 
                     echo'
                     
                    </datalist>
                    
               
                    <label  class="mesajLabel">İçerik</label>
                    <br>
                    <textarea id="message" name="message"   maxlength="100" ></textarea>
                    <button type="submit" id="submitOk" name="gonder" class="mesajGonder">Gönder</button>
            </form>
            </div>
        </div>';
               
        } 

?>

<a class="dileksikayet" > Dilek Ve Sikayet</a>
<?php

    include './parcali/footer.php';
?>
</body>
</html>

