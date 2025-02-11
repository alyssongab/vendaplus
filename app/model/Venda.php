<?php

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
    public $prdutos;

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
        $this->data_venda = date('Y-m-d H:i:"s');

        // INSERIR VENDA NO BANCO
        $obDatabase = new Conexao('vendas');
        echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;

        // ATRIBUIR O ID DA VAGA NA INSTANCIA


        // RETORNAR SUCESSO
    }

}