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

// Obtém todos os registros de vendas com paginação
$vendas = $venda->listar(null, 'data_venda DESC', $limit, $offset);

// conta o cotal de registros pra calcular o numero de paginas
$totalVendas = $venda->contarTotal();
$totalPages = ceil($totalVendas / $limit);

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

