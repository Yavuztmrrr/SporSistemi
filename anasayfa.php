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

  <title>Anasayfa</title>


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
        $girisyapancoding=$_SESSION["sporsistemi"][0]['AktivasyonKodu'];
		$ogrenciId=$girisYapanId;
        $OgrenciIdsifreli = base64_encode($ogrenciId);

        $liste=null;
        $result=null;
        $sonucOgrenci = $mysqli->query("SELECT * FROM tbl_ogrenci where Id = $girisYapanId and Email = '$girisYapanEmail' " );
        $satir = $sonucOgrenci->fetch_row();

        if($satir>0){
            $bransListe = $mysqli->query("select * from tbl_brans");
            $sayi=1;
            $sayi1=1;          
                 if($sayi=1){
                        echo '
                        <div class=" "  style="  margin-top:35px">
                            <div style=" width:100%; margin:0 auto;" class="row">
                        ';
                    $sayi=0;
                 }
                 for ($i = 0; $i < $bransListe->num_rows; $i++) {
                    $satir = $bransListe->fetch_row();
    
                echo '
                <div class="col-md-3" >
          
                <div class="panel panel-default card">
    
                    <div class="panel-heading post-thumb">
                        <img class="img img-responsive" style="width:400px; margin:0 auto; height:200px;" src="data:image/jpeg;base64, ' . base64_encode($satir[1]) . '" />
                    </div>
    
                    <div class="panel-body post-body">
                        <a class="label label-default" href="#">Aktif</a>
                            <h3 class="post-title">
                            <p style="font-size:16px">' . $satir[3] .'</p>
                            </h3>
    
                            
                            <div class="post-author">
                                <img class="author-photo" height="32" src="https://3.bp.blogspot.com/-Reoz1l_Q0RE/WKuilfzo8JI/AAAAAAAAEGY/Kg3cJZ6qE4g8FH1E35svGLmzGEjRHpMsACPcB/s100/pp-hitamputih-02-2017.jpg" width="32">
                                <a href="bransonlinekoc.php?detay=' .  base64_encode($satir[0]) .  '&islem=' .$OgrenciIdsifreli .'">' . $satir[2] .'</a>
                            </div>
                        
                    </div>
    
                </div>
            </div>
          
                
                ';


            }       
        }
        else{
            
            $girisyapanOnlineKocBransi=$_SESSION["sporsistemi"][0]['BransId'];
            $haberliste = $mysqli->query("select * from tbl_onlinekochaber where BransId=$girisyapanOnlineKocBransi order by Id desc");
            echo '';
            echo '<div class="icerikonlinekocanasayfa"  >
            <a class="onlinekocbtn" href="egitimonay.php">Egitiminize katılmak isteyen ogrenciler</a>
            </div>';
            for ($i = 0; $i < $haberliste->num_rows; $i++) {
                $liste = $haberliste->fetch_row();
               
                
                echo '
                <div class="haberbosluk">
                <div class="card haber" >
                <div class="card-body">
                <img src="data:image/jpeg;base64, ' . base64_encode($liste[1]) . '" class="haberresim"  alt="">
                  <h3 class="card-title">' . $liste[3] . '</h3>
                  <p class="card-text">' . $liste[4] . '</p>
                </div>
              </div>
              </div> 
                ';
             
            }
            echo '<div class="haberaltbosluk"  >
        
            </div>';
        }   
?>


<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>


<?php

    include './parcali/footer.php';
?>
</body>
</html>

