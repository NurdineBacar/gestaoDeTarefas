<?php

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if ($id) {
    try {
        $query = "DELETE FROM tarefa WHERE referencia = :id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Falha ao excluir a tarefa.';
        }
    } catch (PDOException $e) {
        $response['message'] = 'Erro ao excluir a tarefa: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'ID não fornecido.';
}

echo json_encode($response);
?>
