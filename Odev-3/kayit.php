<?php
    session_start();
    $adsoyad = $_POST["adsoyad"];
    $telefon = $_POST["telefon"];
     
    $baglan = new PDO("mysql:host=localhost;dbname=kayitlar;charset=utf8","cuni","6152");
    $sorgu= $baglan->prepare("insert into kayit values(?,?,?)");
    $ekle = $sorgu->execute(array(null,"$adsoyad","$telefon"));

    if($ekle)
        header('Location: liste.php');    
?>