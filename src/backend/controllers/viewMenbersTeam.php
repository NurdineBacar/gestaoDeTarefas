<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');
include_once '../config/conexao.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    // Verificar se o parâmetro 'id_equipe' foi fornecido
    if (!isset($_GET['id_equipe']) || !is_numeric($_GET['id_equipe'])) {
        $response['message'] = 'ID da equipe não fornecido ou inválido.';
        echo json_encode($response);
        exit;
    }

    $idEquipe = intval($_GET['id_equipe']);

    // Query SQL para buscar os membros da equipe com base no id_equipe
    $query = "
        SELECT   u.nome,u.numero_celular,
            e.nome_equipe AS nome_equipe,
            e.id_equipe,
            u.id_utilizador
        FROM 
            utilizador AS u
        JOIN 
            equipe_disponivel AS ed ON u.id_utilizador = ed.id_utilizador
        JOIN 
            equipe AS e ON e.id_equipe = ed.id_equipe
        WHERE 
            e.id_equipe = :id_equipe;";

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id_equipe', $idEquipe, PDO::PARAM_INT);
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
