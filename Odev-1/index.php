<?php
    $ciftlik = array(6, 45, 147);
    $koyun = $ciftlik[2];
    echo "Toplam Ağıl: $ciftlik[0]<br>Toplam Kapasite: ".($ciftlik[0] * $ciftlik[1])."<br>Toplam Koyun: $ciftlik[2]<br> <hr><br></br.>";

    for($i = $ciftlik[0]; $i > 0; $i--)
    {
        if($koyun >= 0)
        {
            if($koyun >= $ciftlik[1])
                echo "$i. Ağıl: $ciftlik[1] Koyun<br>";
            else
                echo "$i. Ağıl: $koyun Koyun<br>";
            $koyun -= $ciftlik[1];
        }
        else
            echo "$i. Ağıl: 0 Koyun<br>";
    }
    if($ciftlik[2] > $ciftlik[1] * $ciftlik[0])
        echo "<br>Dışarıda Kalan Koyun: $koyun Koyun<br>"; 
?>