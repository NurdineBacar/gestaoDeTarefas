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

    $nome = $data['nome_equipe'] ?? '';
    $id_gestor = $data['selecionado'] ?? '';

     $query = "INSERT INTO equipe(nome,id_gestor)VALUES (:nome,:id_gestor)";
    $stmt = $connect->prepare($query);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':id_gestor', $id_gestor);

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

