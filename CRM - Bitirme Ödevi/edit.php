<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Güncelleme</title>
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
    <form action = "edit.php" method = "post" enctype = "multipart/form-data">
        <p>Müşteri Adı:<br><input type = "text" name = "customername" required><br></p>
        <p>Vergi Dairesi:<br><input type = "text" name = "taxAdministration" required><br></p>
        <p>Vergi Numarası:<br><input type = "number" name = "taxNumber" required><br></p>
        <p>Adres:<br><input type = "text" name = "address" required><br></p>
        <p>Telefon:<br><input type = "tel" name = "phone"  maxlength = "10" minlength = "10" required><br></p>
        <p>E-mail:<br><input type = "text" name = "email" required><br></p>
        <!--Firma Logosu:<input type = "file" name = "logo" required>      -->
        <?php
            session_start();
            if(isset($_GET["id"]))
            {
                $id = $_GET["id"];
                echo "<input type = 'hidden' name = 'tempId' value = '$id'>"; 
            }
        ?>        
        <input type="submit" name = "button" value = "Güncelle">
    </form>
</body>
</html>

<?php

    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }
    else if(isset($_POST["customername"]) && isset($_POST["taxAdministration"]) && isset($_POST["taxNumber"]) 
        && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["email"]) /*&& isset($_FILES["logo"])*/)
    {
        $id = $_POST["tempId"];
        $customerName = $_POST["customername"];
        $taxAdministration = $_POST["taxAdministration"];
        $taxNumber = $_POST["taxNumber"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        //$tempLogo = $_FILES["logo"]["tmp_name"];
        //$logo = $_FILES["logo"]["name"];
        //move_uploaded_file($tempLogo, $logo);
        echo "id: $id<br>";
        
        $connection = new PDO("mysql:host=localhost;dbname=crm;charset=utf8","cuni","6152");
        $updateQuery = $connection->prepare("update customer set customername=?, taxAdministration=?, taxNumber=?, address=?, phone=?, email=? where id=?");
        $update = $updateQuery->execute(array("$customerName","$taxAdministration","$taxNumber","$address","$phone","$email",$id));
        
        if($update)
        {
            header("location: list.php");
        }
        else
            echo "HATA: Kayıt Güncellenemedi!!!";       
    }
?>