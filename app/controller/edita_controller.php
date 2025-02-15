<?php

require_once __DIR__ . '/../model/Venda.php';

// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Permite requisições de qualquer origem (útil para desenvolvimento)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do corpo da requisição
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data && isset($data->id_venda) && isset($data->status_venda)) {
        $idVenda = $data->id_venda;
        $statusVenda = $data->status_venda;

        $obVenda = new Venda();

        $atualizado = $obVenda->editar($idVenda, $statusVenda);

        if ($atualizado) {
            $response = ["success" => true, "message" => "Status alterado com sucesso."];
        } else {
            $response = ["success" => false, "message" => "Houve um erro ao tentar alterar o status."];
        }
    } else {
        $response = ["success" => false, "message" => "Campos id_venda e status_venda inválidos."];
    }
} else {
    http_response_code(405);
    $response = ["success" => false, "message" => "Método não permitido."];
}

// Envia a resposta JSON
echo json_encode($response);
exit;
?>