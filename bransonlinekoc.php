<?php
include './yetki.php';
$bransid=$_GET["detay"];
$OgrenciId=$_GET["islem"];
$OnlineKocId=0;
$OgrenciIdcozum = base64_decode($OgrenciId);
$BransIdcozum = base64_decode($bransid);

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
    <title>Online Koçlar</title>
</head>
<body style="background-color:powderblue;">  

<?php
    include './parcali/menu.php';
    include './dbconnect.php';
    include './islem.php';
?>
       <nav  style="width:98%; margin:0 auto; padding-top:32px " aria-label="breadcrumb" class="main-breadcrumb">
                         <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="#">Online Koçlar</a></li>
                     
                         </ol>
             </nav>     
<?php
 
             $bransliste = $mysqli->query("SELECT * FROM tbl_brans where Id=$BransIdcozum ");    
             $onlinekocliste = $mysqli->query("SELECT * FROM tbl_onlineKoc where BransId=$BransIdcozum ");
             $sayi=1;
             $deger=2;
            
                  if($sayi=1){
                         echo '
                      
                          
                         <div class=""  style="   margin-top:35px">
                             <div style=" width:100%; margin:0 auto;" class="row">
                            
                         ';
                     $sayi=0;
                    
                  } 
                  $suankizaman = new DateTime;
                  $nkeredon=1;
                  for ($i = 0; $i < $onlinekocliste->num_rows; $i++) {
                     $satir = $onlinekocliste->fetch_row();
                   
                         for ($j = 0; $j < $bransliste->num_rows; $j++) {
                              $sutun = $bransliste->fetch_row();

                              if($nkeredon==1){
                                $brans='' . $sutun[2] .'' ;
                                $resim='data:image/jpeg;base64, ' . base64_encode($sutun[1]) . '';
                                $nkeredon=0;
                              }
                              

                              $tarih= date_create($satir[5]);
                            
                         $kacsene= date_format($suankizaman, 'Y')-date_format($tarih, 'Y');
                       
                         if($kacsene==0){
                            $kacsene="0,1";
                         }
                         else{
                          $kacsene;
                         }

                        
                       
                 echo '
         
               
                 <div class="col-md-3" >
           
                 <div class="panel panel-default card">
                     <div class="panel-heading post-thumb">
                         <img class="img img-responsive" style="width:400px; margin:0 auto; height:200px;" src="'.$resim.'" />
                     </div>

                     <div class="panel-body post-body">
             

                             <h3 class="post-title">
                             <h3 style=" font-weight: bold; text-align:center;">' . $satir[1] .' ' . $satir[2] .'</h3>
                             </h3>
                             <h3 class="post-title">
                             <h4 style=" text-align:center;">' . $brans .'  </h4>
                             </h3>
                             <h3 class="post-title">
                             <h5 style=" text-align:center;">' .$kacsene .' Senedir Çalışıyor  </h5>
                             </h3>
                           
                            <h3 class="post-title">
                            <h5 style=" text-align:center;">' . $satir[7] .' TL  </h5>
                            </h3>
                            <h3 class="post-title">
                            <h5 style=" text-align:center;">' . $satir[3] .'</h5>
                            </h3>
                            <br>
  
                            <a href="egitimeogrenciekle.php?islemOk=' . base64_encode($satir[0]) . '&islemO=' . base64_encode($OgrenciIdcozum)  .'&islemE=' . base64_encode($satir[3])  .' "><button class="btnsec"  type="button" >Sec</button></a>
                            
                     </div>
                     </div>
                     </div>
         
                     ';
                
            
               
             }

             } 
      
        
?>

<a class="dileksikayet" href="dilekvesikayet.php?id=<?php echo base64_encode($girisYapanId)  ?>">Dilek Ve Sikayet</a>

<?php

    include './parcali/footer.php';
?>

</body>
</html>
