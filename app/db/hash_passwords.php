<?php
// filepath: /C:/xampp/htdocs/vendaplus/hash_passwords.php
require_once __DIR__ . '/Conexao.php';

try {
    $conexao = new Conexao('usuarios');

    $query = "SELECT id_user, senha FROM usuarios";
    $stmt = $conexao->execute($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id_user = $row['id_user'];
        $senha = $row['senha'];

        // Hash the password
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_query = "UPDATE usuarios SET senha = :senha WHERE id_user = :id_user";
        $update_stmt = $conexao->execute($update_query, [":senha" => $hashed_password, ":id_user" => $id_user]);

        echo "Hashed password for user ID: " . $id_user . "<br>";
    }

    echo "All passwords hashed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
