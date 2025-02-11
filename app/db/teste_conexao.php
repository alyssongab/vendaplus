<?php

require_once 'conexao.php';

try {
    $conexao = new Conexao();
    $conn = $conexao->conectar();
    if ($conn) {
        echo "Conexão bem-sucedida!";
    } else {
        echo "Falha na conexão.";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}