<?php
header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');
include_once '../config/conexao.php';

try {

    $id_user = $_GET['id_user'] ?? null;
    // $id_equipe = 1;

    if ($id_user) {
        $query_equip = "SELECT id_equipe FROM equipe_disponivel WHERE id_utilizador = :id_user";
        $stmt_equip = $connect -> prepare($query_equip);
        $stmt_equip ->bindParam(':id_user', $id_user);
        $stmt_equip -> execute();

        $result = $stmt_equip -> fetch(PDO::FETCH_ASSOC);

        // Busca os membros da equipe
        $query = "SELECT u.id_utilizador, u.nome, u.email, u.numero_celular
                  FROM utilizador u
                  JOIN equipe_disponivel ed ON u.id_utilizador = ed.id_utilizador
                  WHERE ed.id_equipe = :id_equipe";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':id_equipe', $result['id_equipe'], PDO::PARAM_INT);
        $stmt->execute();
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Busca as tarefas dos membros da equipe
        $query_tarefas = "SELECT t.*, u.*
                          FROM tarefa t
                          JOIN utilizador u ON t.id_utilizador = u.id_utilizador
                          WHERE u.id_utilizador IN (SELECT id_utilizador FROM equipe_disponivel WHERE id_equipe = :id_equipe)";
        $stmt_tarefas = $connect->prepare($query_tarefas);
        $stmt_tarefas->bindParam(':id_equipe', $result['id_equipe'], PDO::PARAM_INT);
        $stmt_tarefas->execute();
        $tasks = $stmt_tarefas->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'members' => $members, 'tasks' => $tasks]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID da equipe não fornecido.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
