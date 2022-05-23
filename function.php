<?php
 
 
function ogrenciinfo($id,$email)
{
   
    global $db;
    return $db->query("SELECT * FROM tbl_ogrenci WHERE Id = '".$id ."' and Email = '".$email ."'")->fetch();
    
}

function onlinekocinfo($id,$email)
{
    global $db;
    return $db->query("SELECT * FROM tbl_onlinekoc WHERE Id = '".$id ."' and Email='".$email ."'")->fetch();   
}
function onlinekocCagirma($id)
{
   
    global $db;
    return $db->query("SELECT * FROM tbl_onlinekoc WHERE Id = '".$id ."' ")->fetch();   
}
function ogrenciCagirma($id)
{
   
    global $db;
    return $db->query("SELECT * FROM tbl_ogrenci WHERE Id = '".$id ."' ")->fetch();

    
}
?>