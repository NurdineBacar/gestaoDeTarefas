<?php


header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
    $referencia = substr(md5(uniqid(rand(), true)), 0, 6); 
    $data = json_decode(file_get_contents('php://input'), true);
    $titulo = $data['titulo'] ?? '';
    $prioridade = $data['prioridade'] ?? 'Alta';

    $query = "INSERT INTO tarefass (referencia, titulo, prioridade) VALUES (:referencia, :titulo, :prioridade)";
    $stmt = $connect->prepare($query);

    $stmt->bindParam(':referencia', $referencia);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':prioridade', $prioridade);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Dados inseridos com sucesso.';
    } else {
        $response['message'] = 'Erro ao inserir dados.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
}


echo json_encode($response);

