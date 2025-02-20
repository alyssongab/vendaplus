<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendaplus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      textarea{
        min-height: 50px;
        resize: none;
      }

      .hd {
        background-color: #023e8a;
        color: white;
      }

      .table{
        --bs-table-hover-bg:rgb(197, 214, 240);
      }

      @media (max-width: 768px) {
      #tabela-vendas thead {
          display: none; /* Oculta o cabeçalho da tabela */
      }

      #tabela-vendas tbody tr {
          display: block; /* Transforma cada linha em um bloco */
          margin-bottom: 0.5rem; /* Adiciona um espaço entre as linhas */
          border: 1px solid #ddd; /* Adiciona uma borda para melhor visualização */
      }

      #tabela-vendas td {
          display: block; /* Transforma cada célula em um bloco */
          text-align: right; /* Alinha o texto à direita */
          border-bottom: 1px dotted #ddd; /* Adiciona uma borda inferior pontilhada */
      }

      #tabela-vendas td:last-child {
          border-bottom: none; /* Remove a borda da última célula */
      }

      #tabela-vendas td::before {
          content: attr(data-label); /* Exibe o conteúdo do atributo data-label */
          float: left; /* Alinha o texto à esquerda */
          text-transform: uppercase; /* Transforma o texto em maiúsculas */
          font-weight: bold; /* Define o texto como negrito */
      }
    }

    @media (max-width: 768px) {
      #tabela-vendas {
          font-size: 0.8rem; /* Reduz o tamanho da fonte */
      }

      #tabela-vendas td,
      #tabela-vendas th {
          padding: 0.5rem; /* Reduz o espaçamento interno */
      }

      #nova-venda{
        padding: 5;
        font-size: 0.83rem;
        width: 7rem;
      }

      .btn-check{
        font-size: 0.8rem;
      }
    }

    </style>
  </head>
  <body class="bg-dark">
        <div class=" p-3 text-light bg-gradient" style="background-color: #023e8a;">
            <h1>VPlus</h1>
            <!-- <h5>Sistema para gestão de vendas</h5> -->
        </div>
 
    <div class="container">
     