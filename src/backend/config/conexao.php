<?php
  
  header('Content-Type: application/json');

  // Permite requisições de qualquer origem (para desenvolvimento)
  header('Access-Control-Allow-Origin: *'); 
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
  header('Access-Control-Allow-Headers: Content-Type');
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestaotarefas";

try {

    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

