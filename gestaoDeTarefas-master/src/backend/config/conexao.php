<?php
  

  
$servername = "localhost";
$username = "root";
$password = "0786";
$dbname = "gestaoTarefa";

try {
    // Crie uma nova conexão PDO
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

