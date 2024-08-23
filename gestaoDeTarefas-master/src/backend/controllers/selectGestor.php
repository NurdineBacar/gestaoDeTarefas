<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try{
    $query = "SELECT u.id_utilizador,u.nome FROM utilizador as u join perfil as p on p.id = u.perfil_id where p.nome_perfil = 'gestor'"; 
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