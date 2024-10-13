<?php

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

$response = ['success' => false, 'message' => ''];

try {
   
    $data = json_decode(file_get_contents('php://input'), true);

    $nome = $data['nomeColaborador'] ?? '';
    $email = $data['email'] ?? '';
    $numero = $data['numero'] ?? '';
    $senha = $data['senha'] ?? '';
    $perfil = $data['perfil_acesso'] ?? '';
    // $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
    $senha_criptografada = $senha;
 

    $query = "INSERT INTO utilizador (nome, email, numero_celular, senha,perfil) VALUES (:nome, :email, :numero, :senha, :perfil)";
    $stmt = $connect->prepare($query);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':senha', $senha_criptografada);
    $stmt->bindParam(':perfil', $perfil);

    if ($stmt->execute()) {
        $query = "DELETE FROM utilizador WHERE email =''";
            $stmt = $connect->prepare($query);
            $stmt -> execute();
        $response['success'] = true;
        $response['message'] = 'Dados inseridos com sucesso.';
    } else {
        $response['message'] = 'Erro ao inserir dados.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
}


echo json_encode($response);

