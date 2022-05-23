<?php
include './mailgonder.php';


function execDb($query)
{   
    $conn = new PDO("mysql:host=localhost; dbname=yst_sporsistemi;", "root", "");
    $hazirlik = $conn->prepare($query);
    $hazirlik->execute();
    $sonuc = $hazirlik->fetchAll();
    return $sonuc ;
}
function okKayit(
    $okadi,
    $oksoyadi,
    $okemail,
    $oksifre,
    $okegitimfiyati,
    $okbransId
) {
        $aktivasyon = rand(1000000, 10000000) . rand(1000000, 10000000);
        $sonuc =  execDb("INSERT INTO tbl_onlinekoc (Adi,Soyadi, Email,Sifre, KayitTarih,AktivasyonKodu, EgitimFiyati, BransId,Durum)  values('$okadi','$oksoyadi','$okemail','$oksifre', CURDATE() ,'$aktivasyon','$okegitimfiyati', '$okbransId', '0');");
        mailGonder($okemail,"SporSistemi Aktivasyon Onayi", '<a href="http://localhost/SporSistemi/aktivasyon.php?key=' . $aktivasyon . '"> Aktivasyon Kodu:'. $aktivasyon .' uyeliğinizi tamamlamak için linke  tıklayınız</a>');  
}
function oKayit(
    $oadi,
    $osoyadi,
    $oemail,
    $osifre 
) {
        $aktivasyon = rand(1000000, 10000000) . rand(1000000, 10000000);
        $sonuc =  execDb("INSERT INTO tbl_ogrenci (Adi,Soyadi, Email,Sifre, KayitTarih,AktivasyonKodu,Durum)  values('$oadi','$osoyadi','$oemail','$osifre', CURDATE() ,'$aktivasyon','0');");
        mailGonder($oemail,"SporSistemi Aktivasyon Onayı", '<a href="http://localhost/SporSistemi/aktivasyon.php?key=' . $aktivasyon . '"> Aktivasyon Kodu:'. $aktivasyon .' uyeliğinizi tamamlamak için linke  tıklayınız</a>');  
}
function egitimalanogrencikayit(
    $ogrenciId,
    $onlineKocId,
    $email
) {
  
        $sonuc =  execDb("insert into tbl_egitimalanogrenciler(OgrenciId, OnlineKocId, KayitTarih, Durum)   values('$ogrenciId','$onlineKocId',NOW(),'P'); ");
        mailGonder($email,"Spor Sistemi Ogrenci Onayi", '<a href="http://localhost/SporSistemi/egitimonay.php"> Yeni ogrenci eğitiminize katılmak istiyor onaylamak istiyorsanız tıklayın</a>');  
}
function odemeformu(
    $egitimId,
    $odenecektutar,
    $email,
    $brans
) {
        mailGonder($email,"Spor Sistemi Ogrenci Onayi", '<a href="http://localhost/SporSistemi/odeme.php">'. $brans .' Dalinda basvuru yaptığınız Online Kocunuz istegi kabul etti Odeme yapmak için tıklayınız</a>');  
}

