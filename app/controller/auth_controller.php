<?php

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../model/Usuario.php';

$status = false;
$messagem = "";
$data = [];

if ($_GET['action'] === 'login') {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // captura os dados
        $data = json_decode(file_get_contents("php://input"), true);
        if (!is_array($data)) {
            echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
            return;
        }

        if (isset($data['email']) || isset($data['senha'])){
            $email = $data['email'] ?? '';
            $senha = $data['senha'] ?? '';

            $usuario = Usuario::autenticar($email, $senha);
            if ($usuario) {
                $status = true;
                $usuario->iniciarSessao();
                $messagem = 'Logado com: '. $email . ' e senha: ' . $senha;
                $data = [
                    "id" => $usuario->getIdUser(),
                    "nome" => $usuario->getNome(),
                    "email" => $usuario->getEmail()
                ];
                echo json_encode(['status'=> $status,'message'=> $messagem, 'data'=> $data]);
            }
            else {
                $messagem = "Falha ao fazer login: Credenciais incorretas ou inválidas!";
                echo json_encode(['status'=> $status,'message'=> $messagem]);
            }
        }
        else{
            $messagem = "Dados incompletos ou inválidos";
            echo json_encode(['status'=> $status,'message'=> $messagem]);
        }
   
    } else{
        $messagem = "Método de requisição não permitido!";
        echo json_encode(['status'=> $status,'message'=> $messagem]);
    }
}

if ($_GET['action'] === 'logout') {
    Usuario::logout();
    $status = true;
    $messagem = 'Logout realizado';
    echo json_encode(['status'=> $status,'message'=> $messagem]);
}

