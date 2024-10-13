<?php
include_once '../config/conexao.php';

$entidade = $_POST['entidade'];

// Realize uma consulta com base na entidade selecionada
if ($entidade === 'Tarefa') {
    $query = "SELECT id_tarefa AS id, titulo FROM tarefa";
} elseif ($entidade === 'Reclamacao') {
    $query = "SELECT id_reclamacoes AS id, titulo FROM reclamacoes";
} elseif ($entidade === 'Comunicacao') {
    $query = "SELECT id_comunicacao AS id, titulo FROM comunicacao";
} else {
    echo json_encode([]);
    exit();
}

$result = mysqli_query($conn, $query);

$entities = [];
while ($row = mysqli_fetch_assoc($result)) {
    $entities[] = [
        'val' => $row['id'],
        'title' => $row['titulo'], // Mudando 'title' para 'titulo'
    ];
}

echo json_encode($entities);
?>
