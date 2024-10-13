<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
    // Gerando referência única
    $referencia = intval(substr(uniqid('', true), -6));
    $data = json_decode(file_get_contents('php://input'), true);

    // Capturando os dados do JSON
    $titulo = $data['titulo'] ?? '';
    $prioridade = $data['prioridade'] ?? 'Alta';
    $entidade = $data['entidade'] ?? null;
    $dataConclusao = $data['dataConclusao'] ?? null;
    $alvo = $data['alvo'] ?? '';
    $local = $data['local'] ?? '';
    $descricao = $data['descricao'] ?? '';
    $items = $data['items'] ?? [];
    $id_utilizador = $data['id_utilizador'] ?? null;
   

    // Validando id_utilizador
    if (empty($id_utilizador)) {
        throw new Exception("ID do utilizador não fornecido.");
    }


    foreach ($items as $item) {
        // Query de inserção na tabela 'tarefa'
        $query = "INSERT INTO tarefa (referencia, titulo, nivel_prioridade, dataHora_Esperadaexecucao, detalhes, id_utilizador, local_execucao) 
        VALUES (:referencia, :titulo, :prioridade, :dataConclusao, :descricao, :id_utilizador, :local)";
        $stmt = $connect->prepare($query);

        // Bind dos parâmetros
        $stmt->bindParam(':referencia', $referencia);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':prioridade', $prioridade);
        $stmt->bindParam(':dataConclusao', $dataConclusao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id_utilizador', $item);
        $stmt->bindParam(':local', $local);


         // Executando a query de inserção
    if ($stmt->execute()) {
        $lastInsertId = $connect->lastInsertId();


        $response['success'] = true;
        $response['message'] = 'Dados inseridos com sucesso.';
    } else {
        $response['message'] = 'Erro ao inserir dados.';
    }
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
