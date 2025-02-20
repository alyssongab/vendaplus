<?php

require_once __DIR__ . '/../model/Venda.php';

// Permite requisições de qualquer origem (útil para desenvolvimento)
header("Access-Control-Allow-Origin: *");

// Define o tipo de conteúdo da resposta como JSON
header("Content-Type: application/json");

// Cria uma instância da classe Venda
$venda = new Venda();

// Obtém a página atual e define o limite de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // número de registros por página
$offset = ($page - 1) * $limit;
$customerName = isset($_GET['customerName']) ? $_GET['customerName'] : null;

// Verifica se o nome do cliente foi fornecido
if ($customerName) {
    // Obtém os registros de vendas filtrados pelo nome do cliente com paginação
    $vendas = $venda->getByCustomer($customerName, 'data_venda DESC', $limit, $offset);
    //conta o total de registros filtrados
    $totalVendas = count($vendas);
    $totalPages = ceil($totalVendas / $limit);
} else {
    // Obtém todos os registros de vendas com paginação
    $vendas = $venda->listar(null, 'data_venda DESC', $limit, $offset);

    // Conta o total de registros para calcular o número de páginas
    $totalVendas = $venda->contarTotal();
    $totalPages = ceil($totalVendas / $limit);
}

// Verifica se a consulta retornou resultados
if ($vendas) {
    // Converte os resultados para JSON e envia como resposta
    echo json_encode([
        'vendas' => $vendas,
        'totalPaginas' => $totalPages,
        'paginaAtual' => $page
    ]);

} else {
    // se não houver vendas, retorna um array vazio em JSON
    echo json_encode([]);
}

?>

