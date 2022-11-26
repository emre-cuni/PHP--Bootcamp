<?php
    $baglan = new PDO("mysql:host=localhost;dbname=tckimlik;charset=utf8","cuni","6152");
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
    <table border = "1">
        <thead>
            <td>Id</td>
            <td>Ad Soyad</td>
            <td>TC Kimlik</td>
            <td>Durum</td>
        </thead>
        <tbody>
            <?php
                $sorgu = $baglan->query("select * from tckimlik",PDO::FETCH_ASSOC);
                foreach ($sorgu as $kayit)
                {
                    $id = $kayit["id"];
                    $adSoyad = $kayit["adsoyad"];
                    $tc = $kayit["tc"];
                    $durum = $kayit["durum"];
                    
                    echo "<tr>
                            <td>$id</td>
                            <td>$adSoyad</td>
                            <td>$tc</td>";
                    if($durum)
                        echo "<td>Tc Kimlik Geçerli</td></tr>";
                    else    
                        echo "<td>Tc Kimlik Geçersiz</td></tr>";
                            
                        
                }
            ?>
        </tbody>
    </table>
</body>
</html>