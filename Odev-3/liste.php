<?php
    $baglan = new PDO("mysql:host=localhost;dbname=kayitlar;charset=utf8","cuni","6152");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="liste.php" method="post">
        <table border="1">
            <thead>
                <td>Adı Soyadı</td>
                <td>Telefon Numarası</td>
                <td>İşlem</td>
            </thead>
            <tbody>
                <?php
                    session_start();
                    
                    $sorgu = $baglan->query("select * from kayit",PDO::FETCH_ASSOC);
                    $kayitSayisi = 0;
                    foreach($sorgu as $satir)
                    {
                        $kayitSayisi++;
                        $id = $satir["id"];
                        $adsoyad = $satir["adsoyad"];
                        $telefon = $satir["telefon"];
                        echo "<tr>
                            <td>$adsoyad</td>
                            <td>$telefon</td>
                            <td><input type = 'submit' name = '$id' value = 'Sil' ></td>
                        </tr>";
                        
                        if(isset($_POST[$satir["id"]]))
                        {
                            $sorgu = $baglan->prepare("delete from kayit where id=?");
                            $sil = $sorgu->execute(array($id));
    
                            if($sil)
                            {
                                header('Location: liste.php');
                            }
                        }                        
                    }
                    echo "<tr> 
                        <td colspan='3'> Sistemde Toplam - $kayitSayisi - Kayıt var </td>
                    </tr>";
                ?>                
            </tbody>
        </table>
    </form>
</body>
</html>