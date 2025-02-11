<?php

require_once __DIR__ . '/../model/Venda.php';

$cadastroSucesso = false;
$dados = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])){
        $cadastroSucesso = true;
        
        // sanitiza os dados
        $produtos = htmlspecialchars($_POST['produtos']);
        $valor = floatval($_POST['valor']);
        $cliente = htmlspecialchars($_POST['cliente']);
        $status = htmlspecialchars($_POST['status']);

         // cria uma nova instância da classe Venda e registra a venda
         $obVenda = new Venda;
         $obVenda->produtos = $produtos;
         $obVenda->valor = $valor;
         $obVenda->cliente = $cliente;
         $obVenda->status_venda = $status;
 
         // realiza o cadastro
         $obVenda->cadastrar();

        $data = [
            'Produtos' => $produtos,
            'Valor' => $valor,
            'Cliente' => $cliente,
            'Status' => $status
        ];
    }
    else {
        $cadastroSucesso = false;
    }
    
    // retorna como json
    header('Content-Type: application/json');
    echo json_encode(['cadastroSucesso' => $cadastroSucesso, 'data' => $data]);
    exit;
}

?>
