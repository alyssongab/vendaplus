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


    /**
     * Método responsável por cadastrar uma nova venda no banco
     * @return boolean
     */
    public function cadastrar(){
        // DEFINIR A DATA
        date_default_timezone_set('America/Manaus'); // Define o timezone para Manaus
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
     * Método responsável por obter as vendas do banco
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function listar($where = null, $order = null, $limit = null){
        //INSTANCIA DA CONEXAO
        $obDatabase = new Conexao('vendas');
        $statement = $obDatabase->select($where, $order, $limit);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Formata a data e hora para d/m/Y H:i:s
        foreach ($dados as &$dado) {
            $data_hora_utc = new DateTime($dado['data_venda']);

            $timezone = new DateTimeZone('America/Manaus');
            $data_hora_utc->setTimezone($timezone);

            $dado['data_venda'] = $data_hora_utc->format('d/m/Y H:i:s');
        }
        
        return $dados;

    }

}