<?php

require_once __DIR__ . '/../model/Venda.php';

// Permite requisições de qualquer origem (útil para desenvolvimento)
header("Access-Control-Allow-Origin: *");

// Define o tipo de conteúdo da resposta como JSON
header("Content-Type: application/json");

// Cria uma instância da classe Venda
$venda = new Venda();

// Obtém todos os registros de vendas
$vendas = $venda->listar();

// Verifica se a consulta retornou resultados
if ($vendas) {
    // Converte os resultados para JSON e envia como resposta
    // echo json_encode($vendas);
} else {
    // Se não houver vendas, retorna um array vazio em JSON
    echo json_encode([]);
}

?>

