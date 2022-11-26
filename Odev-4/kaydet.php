<?php

    session_start();
    echo $_POST["adSoyad"]." - ".$_POST["tc"];
    $adSoyad = $_POST["adSoyad"];
    $tcKimlik = $_POST["tc"];    

    require_once("class.php");
    
    $vatandas = new TcKimlikKontrol;

    $baglan = new PDO("mysql:host=localhost;dbname=tckimlik;charset=utf8","cuni","6152");
    $sorgu= $baglan->prepare("insert into tckimlik values(?,?,?,?)");
    
    if ($vatandas->TcKontrol($tcKimlik))
        $ekle = $sorgu->execute(array(null,"$adSoyad","$tcKimlik",1)); 
    else
        $ekle = $sorgu->execute(array(null,"$adSoyad","$tcKimlik",0));  
    if($ekle)
        header('Location: liste.php');
?>