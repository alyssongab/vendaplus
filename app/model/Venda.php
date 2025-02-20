<?php

require_once __DIR__ . '/../db/Conexao.php';


class Venda{

    /**
     * Identificador unico da venda
     * @var integer
     */
    public $id_venda;

    /**
     * Produtos listados na venda
     * @var string
     */
    public $produtos;

    /**
     * Valor da venda
     * @var float
     */
    public $valor;

    /**
     * Cliente que comprou o(s) produto(s)
     * @var string
     */
    public $cliente;

    /**
     * Define se está pago ou não
     * @var string(S/N)
     */
    public $status_venda;

    /**
     * Data da venda
     * @var string
     */
    public $data_venda;

    public function __construct()
    {
        date_default_timezone_set('America/Manaus');
    }

    /**
     * Método responsável por cadastrar uma nova venda no banco
     * @return boolean
     */
    public function cadastrar(){
        // DEFINIR A DATA
        // Define o timezone para Manaus
        $this->data_venda = date('Y-m-d H:i:s');

        // INSERIR VENDA NO BANCO
        $obDatabase = new Conexao('vendas');
        $this->id_venda = $obDatabase->insert([
                                                'produtos' => $this->produtos,
                                                'valor' => $this->valor,
                                                'cliente' => $this->cliente,
                                                'status_venda' => $this->status_venda,
                                                'data_venda' => $this->data_venda
                                            ]);

        // RETORNAR SUCESSO
        return true;
    }


      /**
     * Método responsável por obter as vendas do banco com paginação
     * @param  string $where
     * @param  string $order
     * @param  int $limit
     * @param  int $offset
     * @return array
     */
    public function listar($where = null, $order = null, $limit = null, $offset = null) {
        //INSTANCIA DA CONEXAO
        $obDatabase = new Conexao('vendas');
        $statement = $obDatabase->select($where, $order, $limit, $offset);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Formata a data e hora para d/m/Y H:i:s
        foreach ($dados as &$dado) {
            $data_hora_utc = new DateTime($dado['data_venda']);
            
            // altera o formato da data
            $timezone = new DateTimeZone('America/Manaus');
            $data_hora_utc->setTimezone($timezone);
            $dado['data_venda'] = $data_hora_utc->format('d/m/Y H:i:s');
            
            // altera o formato do valor (casas milenares e decimais)
            $num = number_format($dado['valor'], 2, ',', '.');
            $dado['valor'] = $num;

            // altera o status da venda (pago ou pendente)
            $dado['status_venda'] = $dado['status_venda'] == 'S' ? "Pago" : "Pagamento pendente";
        }
        
        return $dados;
    }

    /**
     * Método responsável por contar o total de vendas
     * @return int
     */
    public function contarTotal() {
        $obDatabase = new Conexao('vendas');
        $result = $obDatabase->execute('SELECT COUNT(*) as total FROM vendas')->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    /**
     * Método responsável por editar status da venda
     * @return boolean
     */
    public function editar($idVenda, $statusVenda){
        // Verifica se o ID da venda é um número inteiro válido
        if (!is_numeric($idVenda) || intval($idVenda) <= 0) {
            return false;
        }
    
        // Verifica se o status da venda é um valor válido
        if ($statusVenda !== 'S' && $statusVenda !== 'N') {
            return false;
        }
    
        try {
            // Instancia a conexão com o banco de dados
            $obDatabase = new Conexao('vendas');
    
            // Define os valores para atualizar
            $values = [
                'status_venda' => $statusVenda
            ];
    
            // Define a condição WHERE
            $where = 'id_venda = ' . intval($idVenda); // Garante que o ID seja um inteiro
    
            // Executa a atualização
            $success = $obDatabase->update($where, $values);
    
            // Retorna o resultado da atualização
            return $success;
        } catch (Exception $e) {
            // Em caso de erro, registra o erro e retorna false
            error_log('Erro ao editar status da venda: ' . $e->getMessage());
            return false;
        }
    }

        /**
     * Método responsável por buscar vendas por nome do cliente
     * @param string $customerName
     * @param string $order
     * @param string $limit
     * @param string $offset
     * @return array
     */
    public function getByCustomer($customerName, $order = null, $limit = null, $offset = null) {
        // Instancia a conexão com o banco de dados
        $obDatabase = new Conexao('vendas');

        // Utiliza o método getByCustomer da classe Conexao para buscar as vendas
        $statement = $obDatabase->getByCustomer($customerName, $order, $limit, $offset);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Formata a data e hora para d/m/Y H:i:s
        foreach ($dados as &$dado) {
            $data_hora_utc = new DateTime($dado['data_venda']);
            
            // altera o formato da data
            $timezone = new DateTimeZone('America/Manaus');
            $data_hora_utc->setTimezone($timezone);
            $dado['data_venda'] = $data_hora_utc->format('d/m/Y H:i:s');
            
            // altera o formato do valor (casas milenares e decimais)
            $num = number_format($dado['valor'], 2, ',', '.');
            $dado['valor'] = $num;

            // altera o status da venda (pago ou pendente)
            $dado['status_venda'] = $dado['status_venda'] == 'S' ? "Pago" : "Pagamento pendente";
        }

        return $dados;
    }

}