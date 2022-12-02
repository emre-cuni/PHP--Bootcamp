<?php
    session_start();
    $id = $_GET["id"];
   
    $connection = new PDO("mysql:host=localhost;dbname=crm;charset=utf8","cuni","6152");
    $deleteQuery = $connection->prepare("delete from customer where id = ?");
    $delete = $deleteQuery->execute(array($id));
    
    if($delete)
    {
        echo "silindi<br><br>";
        header("location: list.php");
    }
    else    
        echo "silinmedi<br><br>";

?>