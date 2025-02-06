<?php

namespace App\Entity;

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

}