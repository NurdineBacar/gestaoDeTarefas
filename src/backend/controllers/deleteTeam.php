<?php

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
    // Recebe os dados JSON enviados pelo Vue.js
    $data = json_decode(file_get_contents('php://input'), true);

    // Obtém o ID da equipe para apagar
    $idEquipe = $data['idEquipe'] ?? '';

    // Verifica se o ID foi fornecido
    if (empty($idEquipe)) {
        $response['message'] = 'ID da equipe não fornecido.';
        echo json_encode($response);
        exit;
    }

    // Prepara a query para exclusão da equipe
    $query = "DELETE FROM equipe WHERE id_equipe = :idEquipe";
    $stmt = $connect->prepare($query);

    // Atribui o parâmetro à query
    $stmt->bindParam(':idEquipe', $idEquipe);

    // Executa a query e verifica o resultado
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Equipe eliminada com sucesso.';
    } else {
        $response['message'] = 'Erro ao eliminar a equipe.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao eliminar a equipe: ' . $e->getMessage();
}

// Retorna a resposta em JSON
echo json_encode($response);
