<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try{
    // Obtém dados JSON da requisição
    $data = json_decode(file_get_contents('php://input'), true);
    $id_utilizador = $data['id_utilizador'];

    $query = "SELECT * from equipe_disponivel WHERE id_utilizador = $id_utilizador"; 
    $stmt = $connect->prepare($query);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        $response['success'] = true;
        $response['data'] = $data;
    } else {
        $response['message'] = 'Nenhum dado encontrado.';
    }


} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);