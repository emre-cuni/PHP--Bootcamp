<?php
    if (isset($_POST["customername"]) && isset($_POST["taxAdministration"]) && isset($_POST["taxNumber"])
         && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_FILES["logo"]))
    {
        $tempLogo = $_FILES["logo"]["tmp_name"];
        $logo = $_FILES["logo"]["name"];
        move_uploaded_file($tempLogo,$logo);
        echo "resim yüklendi <img src = '$logo' height = '100'>";
        $customerName = $_POST["customername"];
        $taxAdministration = $_POST["taxAdministration"];
        $taxNumber = $_POST["taxNumber"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        $connection = new PDO("mysql:host=localhost;dbname=crm;charset=utf8","cuni","6152");
        $query = $connection->prepare("insert into customer values(?,?,?,?,?,?,?,?)");
        $add = $query->execute(array(null,"$customerName","$taxAdministration","$taxNumber","$address","$phone","$email","$logo"));
        if($add)
            header("location: list.php");
        else
            echo "Hata: Kayıt Yapılamadı!";            
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ekleme</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color:#FF6002;
            color: #4A4A4A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <form action = "registration.php" method = "post" enctype = "multipart/form-data">
        <p>Müşteri Adı:<br><input type = "text" name = "customername" required><br></p>
        <p>Vergi Dairesi:<br><input type = "text" name = "taxAdministration" required><br></p>
        <p>Vergi Numarası:<br><input type = "number" name = "taxNumber" required><br></p>
        <p>Adres:<br><input type = "text" name = "address" required><br></p>
        <p>Telefon:<br><input type = "tel" name = "phone"  maxlength = "10" minlength = "10" required><br></p>
        <p>E-mail:<br><input type = "text" name = "email" required><br></p>
        <p>Firma Logosu:<br><input type="file" name = "logo" required></p>
        <input type="submit" name = "button" value = "Kaydet">
    </form>
</body>
</html>

