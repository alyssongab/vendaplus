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
            return $this->conn;
        }
        catch(PDOException $e){
            die('Erroq na conexao com o banco: '.$e->getMessage());
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

    /**
     * Método responsável por listar todas as vendas
     * @return object
     */
    public function select($where = null, $order = null, $limit = null){
        // parametros opcionais
        $where = $where != null ? 'WHERE ' . $where : '';
        $order = $order != null ? 'ORDER BY ' . $where : '';
        $limit = $limit != null ? 'LIMIT ' . $limit : ''; 

        // monta a query
        $query = 'SELECT data_venda, cliente, produtos, valor FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        
        // executa a query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
        
    }

}




