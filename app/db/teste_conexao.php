<?php

require_once 'Conexao.php';

try {
    // Instancia a classe Conexao e define a tabela
    $conexao = new Conexao();
    // Tenta conectar ao banco de dados
    $conn = $conexao->conectar();
    if ($conn) {
        echo "Conexão bem-sucedida!";
    } else {
        echo "Erro ao conectar";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}