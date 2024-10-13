<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    if (isset($_GET['id_equipe'])) {
        $id_equipe = $_GET['id_equipe'];
        $query = "SELECT * FROM equipe WHERE id_equipe = :id_equipe";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            $response['success'] = true;
            $response['data'] = $data;
        } else {
            $response['message'] = 'Nenhum dado encontrado.';
        }
    } else {
        $response['message'] = 'Parâmetro id_equipe não fornecido.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);
