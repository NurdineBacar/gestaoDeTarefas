<?php 

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try{
    // $query = "SELECT u.id_utilizador, u.nome, u.email, u.numero_celular,p.nome_perfil FROM utilizador as u join perfil as p on p.perfil_id = u.id_utilizador where nome_perfil <> 'admin';  "; 
    $query = "SELECT * FROM utilizador WHERE perfil != 'administrador'";
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