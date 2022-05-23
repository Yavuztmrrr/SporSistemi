<?php
include './mailgonder.php';

function sifre(
    $kemail
) {
  
    include './dbconnect.php';
    $onlineKocSifre = " SELECT sifre , Email , Id ,AktivasyonKodu FROM tbl_onlinekoc Where Email='$kemail'";
    

    $ogrenciSifre = " SELECT sifre,Email,Id,AktivasyonKodu FROM tbl_ogrenci Where Email='$kemail'";

    $resultOnlineKoc = $mysqli->query($onlineKocSifre); 

    $resultOgrenci = $mysqli->query($ogrenciSifre); 
 
    if ($resultOnlineKoc->num_rows > 0) {

        while ($row = $resultOnlineKoc->fetch_assoc()) {
           
            mailGonder($kemail, "SporSistemi Sifreniz", '<a href="http://localhost/SporSistemi/sifredegistirme.php?coding=' .  $row["AktivasyonKodu"] .  ' ">Şifrenizi yenilemek için tıklayın.</a>');
            $onlineKocGuncelle = $mysqli->query("UPDATE tbl_onlinekoc SET SifreDegismeDurum='1'  Where Id='" .  $row["Id"] .  "' and  Email='" .  $row["Email"] .  "'");
        }
    
    }
   else if ($resultOgrenci->num_rows > 0) {
        while ($row = $resultOgrenci->fetch_assoc()) {
          
            mailGonder($kemail, "SporSistemi Sifreniz", '<a href="http://localhost/SporSistemi/sifredegistirme.php?coding=' .  $row["AktivasyonKodu"] .  ' "> Şifrenizi yenilemek için tıklayın.</a>');
                $onlineKocGuncelle = $mysqli->query("UPDATE tbl_ogrenci SET SifreDegismeDurum='1'  Where Id='" .  $row["Id"] .  "' and  Email='" .  $row["Email"] .  "'");
            }
            
    }
}
