<?php
include_once('../config/conexao.php');

$query = "SELECT * FROM tarefa WHERE estado_tarefa = 'pendente'";
$stmt = $connect->prepare($query);
$stmt->execute();

$registros_pendentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = null; // Fecha o statement (não obrigatório, mas é uma boa prática)
$connect = null; // Fecha a conexão explicitamente

// Retorna os registros pendentes como JSON
echo json_encode($registros_pendentes);
?>
