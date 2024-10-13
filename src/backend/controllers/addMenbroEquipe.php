<?php

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_equipe = $data['id_equipe'];
    $id_utilizador = $data['id_utilizador'];

    // Verifica se o colaborador já está na equipe
    $queryCheck = "SELECT COUNT(*) FROM equipe_disponivel WHERE id_equipe = :id_equipe AND id_utilizador = :id_utilizador";
    $stmtCheck = $connect->prepare($queryCheck);
    $stmtCheck->bindParam(':id_equipe', $id_equipe);
    $stmtCheck->bindParam(':id_utilizador', $id_utilizador);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        $response['message'] = "Colaborador $id_utilizador já existe na equipe.";
    } else {
        // Adiciona o colaborador à equipe
        $query = "INSERT INTO equipe_disponivel (id_equipe, id_utilizador) VALUES (:id_equipe, :id_utilizador)";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':id_utilizador', $id_utilizador);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Colaborador $id_utilizador adicionado com sucesso.";
        } else {
            $response['message'] = "Erro ao adicionar colaborador.";
        }
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
}

echo json_encode($response);
