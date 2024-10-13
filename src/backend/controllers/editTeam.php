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

    // Obtém os valores de nome da equipe e ID da equipe
    $nome = $data['nome_equipe'] ?? '';
    $idEquipe = $data['idEquipe'] ?? '';

    // Verifica se ambos os valores foram fornecidos
    if (empty($nome) || empty($idEquipe)) {
        $response['message'] = 'Nome da equipe ou ID não fornecidos.';
        echo json_encode($response);
        exit;
    }

    // Prepara a query para atualização dos dados
    $query = "UPDATE equipe SET nome_Equipe = :nome WHERE id_equipe = :idEquipe";
    $stmt = $connect->prepare($query);

    // Atribui os parâmetros à query
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idEquipe', $idEquipe);

    // Executa a query e verifica o resultado
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Dados atualizados com sucesso.';
    } else {
        $response['message'] = 'Erro ao atualizar dados.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao atualizar dados: ' . $e->getMessage();
}

// Retorna a resposta em JSON
echo json_encode($response);
