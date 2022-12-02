<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Listesi</title>
    <style>
        body{
            background-color:#FF6002;
        }        
        .list {
            font-family: 'Lato', sans-serif;                
            color: #4A4A4A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        img{
            width: 75px;
        }        
    </style>
</head>
    <body>
        <div>
            <form action = "registration.php" method = "post" style="display: inline;">
                <input type = "submit" value = "Kayıt Ekle">
            </form>
            <form action = "list.php" method = "post" style="display: inline;">
                <input type = "submit" name = "csv" value = "CSV'ye Aktar">
            </form>
            <form action = "list.php" method = "post" style="display: inline;">
                <input type = "text" name = "searchName">
                <input type = "submit" value = "Ara">
            </form>
        </div>
        <br>
        <div id = "list">
            <?php
                $connection = new PDO("mysql:host=localhost;dbname=crm;charset=utf8","cuni","6152");
                $query = $connection->query("select * from customer",PDO::FETCH_ASSOC);
                
                if (isset($_POST["csv"])) //"CSV'ye Aktar" butonuna tıklandığında csv dosyası oluşturur.
                {
                    $csvFile = "customers.csv";
                    touch($csvFile);
                    $csvFile = fopen("customers.csv","wbt");
                }       
                    
                echo"
                    <table border = '1'>
                        <thead>
                            <td>Ad Soyad</td>
                            <td>Vergi Dairesi</td>
                            <td>Vergi Numarası</td>
                            <td>Adres</td>
                            <td>Telefon</td>
                            <td>E-Mail</td>
                            <td>Firma Logosu</td>
                            <td>İşlem </td>
                        </thead>
                        <tbody>";

                foreach ($query as $customer) //
                {
                    if ($customer["customername"] != "")
                    {
                        $id = $customer["id"];                    
                        $customerName = $customer["customername"];
                        $taxAdministration = $customer["taxAdministration"];
                        $taxNumber = $customer["taxNumber"];
                        $address = $customer["address"];
                        $phone = $customer["phone"];
                        $email = $customer["email"];
                        $logo = $customer["company"];
                        

                        if (isset($_POST["csv"])) //"CSV'ye Aktar" butonuna tıklandığında kayıtlı müşterileri csv dosyasına yazar
                            fwrite($csvFile,"$customerName;$taxAdministration;$taxNumber;$address;$phone;$email\n");
                        
                        if (isset($_POST["searchName"])) //müşteri arandıysa aranan isimde bir müşteri varsa onu ekrana verir
                        {
                            $searchName = $_POST["searchName"];
                            
                            if ($searchName == $customerName)
                            {
                                echo "
                                    <tr>
                                        <td>$customerName</td>
                                        <td>$taxAdministration</td>
                                        <td>$taxNumber</td>
                                        <td>$address</td>
                                        <td>$phone</td>
                                        <td>$email</td>
                                        <td><img src = '$logo'></td>
                                        <td>
                                            <a href = 'edit.php?id=$id'>Düzenle</a> /
                                            <a href = 'delete.php?id=$id'>Sil</a>
                                        </td>
                                    </tr>"; 
                            }        
                            /*else
                            {
                                echo "Aranan Müşteri Bulunamadı!<br>";
                                break;
                            }*/
                        }
                        else //arama yapılmadıysa db'de kayıtlı olan bütün müşterileri ekrana verir
                        {
                            echo "
                            <tr>
                                <td>$customerName</td>
                                <td>$taxAdministration</td>
                                <td>$taxNumber</td>
                                <td>$address</td>
                                <td>$phone</td>
                                <td>$email</td>
                                <td><img src = '$logo' witdh = '75'></td>
                                <td>
                                    <a href = 'edit.php?id=$id'>Düzenle</a> /
                                    <a href = 'delete.php?id=$id'>Sil</a>
                                </td>
                            </tr>";
                        }   
                    }
                    else
                    {
                        echo "Kayıtlı Müşteri Bulunamadı!";
                        break;
                    }
                }
                if (isset($_POST["csv"]))
                    fclose($csvFile);
                echo " </tbody>
                </table>";
            ?>
        </div>
    </body>
</html>