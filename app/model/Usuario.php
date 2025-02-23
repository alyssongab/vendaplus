<?php
// app/model/Usuario.php

require_once __DIR__ . '/../db/config.php'; // Inclui o arquivo de configuração
require_once __DIR__ . '/../db/Conexao.php'; // Inclui a classe de conexão

class Usuario {
    // Propriedades do modelo
    private $id_user;
    private $nome;
    private $email;
    private $senha;

    // Construtor
    public function __construct($nome = null, $email = null, $senha = null, $id_user = null) {
        $this->id_user = $id_user;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    // Getters
    public function getIdUser() {
        return $this->id_user;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    /**
     * metodo para autenticar o usuario
     * @param string $email
     * @param string $senha
     * @return Usuario|null
     */
    public static function autenticar($email, $senha){
        // cria conexao com o banco
        $conexao = new Conexao('usuarios');

        // busca pelo email
        $query = "SELECT id_user, nome, email, senha FROM usuarios WHERE email = :email";
        $stmt = $conexao->execute($query, [":email" => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // verifica se o usuario existe e a senha ta correta
        if($row && password_verify($senha, $row["senha"])) {
            return new Usuario($row['nome'], $row['email'], $row['senha'], $row['id_user']);
        }

        return null; // autenticacao falhou
    }

    /**
     * Método para iniciar a sessão
     * @return void
     */
    public function iniciarSessao(){
        session_regenerate_id(true);
        $_SESSION['id_user'] = $this->id_user;
        $_SESSION['nome'] = $this->nome;
        $_SESSION['email'] = $this->email;
    }


    /**
     * Método para fazer logout
     * @return void
     */
    public static function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset(); // remove todas as variaveis
        session_destroy();
    }


    /**
     * Método para verificar se o usuário está logado
     * @return bool
     */
    public static function estaLogado() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['id_user']);
    }

    /**
     * Método para pegar o usuário logado na sessão
     * @return Usuario|null
     */
    public static function getUsuarioLogado(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['id_user'])) {
            return new Usuario($_SESSION['nome'], $_SESSION['email'], null, $_SESSION['id_user']);
        }
        return null;
    }
}