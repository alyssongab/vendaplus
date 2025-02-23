<?php

require_once('config.php');

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
            die('Erro na conexao com o banco: '.$e->getMessage());
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
    public function select($where = null, $order = null, $limit = null, $offset = null){
        // parametros opcionais
        $where = $where != null ? 'WHERE ' . $where : '';
        $order = $order != null ? 'ORDER BY ' . $order : '';
        $limit = $limit != null ? 'LIMIT ' . $limit : ''; 
        $offset = $offset != null ? 'OFFSET ' . $offset : '';

        // monta a query
        $query = 'SELECT * FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit . ' ' . $offset;
        
        // executa a query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
        
    }

    /**
     * Método responsável por editar dados no banco
     * @return boolean
     */
    public function update($where, $values){
        
        // Monta a query
        $fields = array_keys($values);
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        
        // executa a query (update)
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute(array_values($values));

        return $success;
    }

    /**
     * Método responsável por filtrar por nome do cliente
     * @param string $customerName
     * @param string $order
     * @param string $limit
     * @param string $offset
     * @return PDOStatement
     */
    public function getByCustomer($customerName = null, $order = null, $limit = null, $offset = null){
        $customerName = $this->conn->quote('%'. strtolower($customerName) . '%');

        $where = 'LOWER(cliente) LIKE ' . $customerName;

        return $this->select($where, $order, $limit, $offset);
    }

}




