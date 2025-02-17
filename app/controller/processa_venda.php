<?php

require_once __DIR__ . '/../model/Venda.php';

$cadastroSucesso = false;
$data = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])){
        
        // sanitiza os dados
        $produtos = htmlspecialchars($_POST['produtos']);
        $valor = filter_var($_POST['valor'], FILTER_VALIDATE_FLOAT);
        $cliente = htmlspecialchars($_POST['cliente']);
        $status = htmlspecialchars($_POST['status']);

        // Valida os dados
        if ($valor === false) {
            $data = ['erro' => 'Valor inválido'];
        }
        else {
            // Cria uma nova instância da classe Venda e registra a venda
            $obVenda = new Venda;
            $obVenda->produtos = $produtos;
            $obVenda->valor = $valor;
            $obVenda->cliente = $cliente;
            $obVenda->status_venda = $status;

            // Realiza o cadastro
            $cadastroSucesso = $obVenda->cadastrar();

            if ($cadastroSucesso) {
                $data = [
                    'Produtos' => $produtos,
                    'Valor' => number_format($valor, 2, ',', '.'),
                    'Cliente' => $cliente,
                    'Status_venda' => $status
                ];
            } else {
                $data = ['erro' => 'Erro ao registrar a venda'];
            }
        }
    }
    else {
        $data = ['erro' => 'Campos obrigatórios não preenchidos'];
    }
}
else {
    $data = ['erro' => 'Método de requisição inválido'];
}

// Retorna a resposta como JSON
echo json_encode(['cadastroSucesso' => $cadastroSucesso, 'data' => $data]);
exit;


