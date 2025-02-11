<?php

include('config.php');

class Conexao{

    const USER = DB_USER;
    const PASSWORD = DB_PASSWORD;
    
    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia do PDO
     * @var PDO
     */
    private $conn;


    /**
     * Define a tabela, instancia e conexa
     * @param string $table
     */
    public function __construct($table = null){
       $this->table = $table; 
       $this->conectar();
    }

    /**
     * Método responsável por criar conexao com o banco
     */
    public function conectar(){

    try{

        $conn = new PDO("mysql:host=localhost;dbname=vplus", self::USER, self::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e){
        die('Erro: '.$e->getMessage());
        return null;
    }

}

}




