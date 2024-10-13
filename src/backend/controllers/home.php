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
    $query_users = "SELECT email FROM utilizador";
    $stmt_1 = $connect->prepare($query_users);
    $stmt_1->execute();

    $data_1 = $stmt_1->fetchAll(PDO::FETCH_ASSOC);

    $query_tasks = "SELECT estado_tarefa FROM tarefa";
    $stmt_2 = $connect->prepare($query_tasks);
    $stmt_2->execute();

    $data_2 = $stmt_2->fetchAll(PDO::FETCH_ASSOC);

    $query_complaint = "SELECT titulo FROM comunicacao";
    $stmt_3 = $connect->prepare($query_complaint);
    $stmt_3->execute();

    $data_3 = $stmt_3->fetchAll(PDO::FETCH_ASSOC);

    $query_comunication = "SELECT titulo FROM reclamacoes";
    $stmt_4 = $connect->prepare($query_comunication);
    $stmt_4->execute();

    $data_4 = $stmt_4->fetchAll(PDO::FETCH_ASSOC);
    if ($data_1 ) {
        $response['success'] = true;
        $response['utilizador'] = $data_1;
        $response['tarefa'] = $data_2;
        $response['comunicacao'] = $data_3;
        $response['reclamacao'] = $data_4;
    } else {
        $response['message'] = 'Nenhum dado encontrado.';
    }


} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);