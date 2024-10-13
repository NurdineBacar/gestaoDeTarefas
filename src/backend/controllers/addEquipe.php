<?php

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
    // Obtenção dos dados do corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    $nome = $data['nome_equipe'] ?? '';
    $id_gestor = $data['selecionado'] ?? '';

    // Insere a equipe na tabela "equipe"
    $query = "INSERT INTO equipe(nome_equipe) VALUES (:nome)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':nome', $nome);

    if ($stmt->execute()) {
        // Obtém o último ID inserido para a equipe
        $lastInsertId = $connect->lastInsertId();

        // Insere o gestor na tabela "equipe_disponivel"
        $query_equipe = "INSERT INTO equipe_disponivel(id_equipe, id_utilizador) VALUES (:id_equipe, :id_utilizador)";
        $stmt_1 = $connect->prepare($query_equipe);

        $stmt_1->bindParam(':id_equipe', $lastInsertId);
        $stmt_1->bindParam(':id_utilizador', $id_gestor);

        if ($stmt_1->execute()) {
            $query = "DELETE FROM equipe WHERE nome_equipe =''";
            $stmt = $connect->prepare($query);
            $stmt -> execute();

            $response['success'] = true;
            $response['message'] = 'Dados inseridos com sucesso.';
        } else {
            $response['message'] = 'Erro ao inserir dados na equipe_disponivel.';
        }
    } else {
        $response['message'] = 'Erro ao inserir dados na equipe.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);
