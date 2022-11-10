<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action = 'index.php' method = 'post'>
        <?php
            session_start();           
            
            $products = array(
                array("productName" =>  "Ülker Çikolatalı Gofret 40 gr.", "productPrice" => 10, "tradeMark" => "Ulker"),
                array("productName" =>  "Eti Damak Kare Çikolata 60 gr.", "productPrice" => 20, "tradeMark" => "Eti"), 
                array("productName" =>  "Nestle Bitter Çikolata 50 gr.", "productPrice" => 20, "tradeMark" => "Nestle")
            );

            #tablonun başlık kısmı yazdırılır
            echo "
                <table border = '1'>
                    <thead>
                        <td>Ürün Adı</td>
                        <td>Ürün Fiyatı</td>
                        <td>Adet</td>
                    </thead>
                    ";

            foreach ($products as $product) #tablonun içeriği doldurulur
            {
                $productName = $product["productName"];
                $productPrice = $product["productPrice"];
                $tradeMark = $product["tradeMark"];
                echo "
                    <tr>
                        <td>$productName</td>
                        <td>$productPrice</td>
                        <td><input type = 'text' name = '$tradeMark' ></td>
                        </tr>                
                ";
            }
            echo "</table>";

            echo "<br><input type = 'submit' value = 'Ürünü Sepete Ekle' ><br><br>";
            
            $control = false; #butona tıklandığında her ürün için session tanımlanıp tanımlanmadığını kontrol edecek değişken
            foreach ($products as $product) 
                {#her ürün için session tanımlanmışsa "control" değişkenine "true" değerini verir bir ürün için bile session tanımlanmamışsa "control" değişkenine "false değerini verir ve döngüden çıkar
                if(isset($_POST[$product["tradeMark"]]))
                    $control = true;
                else
                {
                    $control = false;
                    break;
                }                    
            }
            
            if($control) #bütün ürünler için session tanımlandıysa sepeti ekrana bastırır
            {
                echo "<hr><b>Sepetiniz:</b><br><br>
                <table border = '3'>
                    <thead>
                        <td>Ürün Adı</td>
                        <td>Adet</td>
                    <td>Toplam</td>
                    </thead>
                <tbody>";
            
                $total = 0;
            
                foreach ($products as $product) 
                {
                    if(isset($_POST[$product["tradeMark"]]) && $_POST[$product["tradeMark"]] != "0" && !empty($_POST[$product["tradeMark"]]))
                    {
                        $productName = $product["productName"];
                        $productPrice = $product["productPrice"];
                        $piece = $_POST[$product["tradeMark"]];
                        $sum = $productPrice * $_POST[$product["tradeMark"]];
                        $total += $sum;
                        echo "
                            <tr>
                                <td>$productName</td>
                                <td>$piece</td>
                                <td>$sum</td>
                            </tr>                
                        ";
                    }                
                }

                echo "<tr>
                        <td colspan = '2'>Genel Toplam</td>
                        <td>$total</td>
                    </tr>
                </tbody>
                </table>
                ";         
            }
        ?>
    </form>

</body>
</html>