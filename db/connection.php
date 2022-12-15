<?php
    $username = "root";
    $password = "";
    $host = "localhost";
    $database = "PI";

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn)
        echo 'Eroare la conectarea bazei de date';  
?>  