<?php

$cadastroSucesso = false;
$dados = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])){
        $cadastroSucesso = true;
        
        // sanitiza os dados
        $produtos = htmlspecialchars($_POST['prodtutos']);
        $valor = floatval($_POST['valor']);
        $cliente = htmlspecialchars($_POST['cliente']);
        $status = htmlspecialchars($_POST['status']);

        $dados = [
            'Produtos' => $produtos,
            'Valor' => $valor,
            'Cliente' => $cliente,
            'Status' => $status
        ];
    }
    
    // retorna como json
    header('Content-Type: application/json');
    echo json_encode(['cadastroSucesso' => $cadastroSucesso, 'data' => $data]);
    exit;
}

?>
