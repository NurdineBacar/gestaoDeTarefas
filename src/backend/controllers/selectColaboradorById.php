<?php 

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        $query = "SELECT u.id_utilizador, u.nome FROM utilizador as u JOIN perfil as p ON p.id = u.perfil_id WHERE p.nome_perfil = 'colaborador' AND u.id_utilizador = :id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            $response['success'] = true;
            $response['data'] = $data;
        } else {
            $response['message'] = 'Nenhum dado encontrado para o ID fornecido.';
        }
    } else {
        $response['message'] = 'ID inválido.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);
