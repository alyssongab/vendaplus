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

            $this->conn = new PDO("mysql:host=localhost;dbname=vplus", self::USER, self::PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e){
            die('Erro: '.$e->getMessage());
        }

    }

    /**
     * Método responsável por executar queries dentro do banco de dados 
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params=[]){
        try{
            $statement = $this->conn->prepare($query);
            $statement->execute($params);
            return $statement;
        }
        catch(PDOException $e){
            die('Erro: '.$e->getMessage());
            return null;
        }
    }

    /**
     * Método responsável por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */
    public function insert($data){
        // dados da query
        $fields = array_keys($data);
        $binds = array_pad([], count($fields),'?');

        // monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',',$binds).')';

        $this->execute($query, array_values($data));

        // retorna o id inserido
        return $this->conn->lastInsertId();
        
    }

}




