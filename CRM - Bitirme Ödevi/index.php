<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRM Giriş</title>
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
            p{
                font-size: 20px;
            }
            input{
                font-size: 20px;
            }
        </style>
    </head>
    <body>    
        <div style="text-align: center;">
            <form action = "index.php" method = "post" class="form-field">
                <p>Yönetici Adı:<br>  <input type = "text" name = "username"  required></p>
                <p>Parola:<br> <input type = "password" name = "password" required></p>
                <p><input type = "submit" value = "Giriş Yap"></p>
            </form> 
        </div>
    </body>
</html>

<?php
    session_start();
    if (isset($_POST["username"]) && isset($_POST["password"])) //"Giriş Yap" butonuna tıklandığında yönetici adı ve parola girilmiş mi kontrol eder
    {
        $connection = new PDO("mysql:host=localhost;dbname=crm;charset=utf8","cuni","6152");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = $connection->query("select * from admin",PDO::FETCH_ASSOC);
        foreach ($query as $admin)
        {
            if($admin["username"] == $username && $admin["password"] == $password) //girilen bilgiler ile db'deki bilgiler aynıysa giriş yapar
                header("Location: list.php");
            else
                echo "Yönetici Bulunamadı";
        }
    }
?> 