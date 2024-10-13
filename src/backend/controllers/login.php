<?php
session_start();

header('Content-Type: application/json');

// Permite requisições de qualquer origem (para desenvolvimento)
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

$response = ['success' => false, 'message' => ''];

try {  
    // Obtém dados JSON da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['nome']) && isset($data['senha'])) {
        $username = $data['nome'];
        $password = $data['senha'];

       
        $query = "SELECT * FROM utilizador WHERE email = :username AND senha = :password";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $username;
            $response['success'] = true;
            $response['user'] = $user;
        } else {
            $response['message'] = 'Nome de utilizador ou senha incorretos!';
        }

    } else {
        $response['message'] = 'Dados incompletos!';
    }

} catch (PDOException $e) {
    $response['message'] = 'Erro ao processar login: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = 'Erro inesperado: ' . $e->getMessage();
}

echo json_encode($response);
