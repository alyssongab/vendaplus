<?php
  require_once '../model/Usuario.php';
  $status = Usuario::estaLogado();
  if(!$status){
    header("Location: login"); 
    exit(); 
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendaplus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

      html, body{
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
      }

      .container {
          flex: 1; /* Isso faz o conteúdo ocupar o espaço restante e empurra o footer para baixo */
      }

      footer {
        width: 100%;
        background-color: #333; 
        color: white;
        text-align: center;
        padding: 5px 0;
      }


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

      #pesquisa-input{
        width: 60%;
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

      #header{
        font-size: 0.8rem;
      }

      #logout-btn{
        font-size: 0.8rem;
      }

      #pesquisar-span{ /* Ocuta a palavra 'pesquisar' */
        display: none;
      }

      #pesquisa-area{
        justify-content: space-between;
      }

      #pesquisa-input{ /* barra de pesquiar por cliente ocupa toda a largura */
        width: 100%;
      }

    }

    @media (max-width: 396px){ /* seção fica disposta em colunas para melhor visualização */
      #above-table{
        flex-direction: column;
        gap: 10px;
      }
      pesquisa-input{
        width: auto;
      }
    }

    @media (max-width: 256px){
      #spann, nome {
        display: none;
      }
    }

    @media (max-width: 276px){
      footer {
        display: none;
      }

      #pagination, #pag {
        font-size: 0.8rem;
        height: fit-content;
        width: fit-content;
      }

    }

    #github{
      text-decoration: none;
      color:rgb(184, 91, 30);
    }

    </style>
  </head>
  <body class="bg-dark">
        <div class="d-flex justify-content-between p-3 text-light bg-gradient" style="background-color: #023e8a;">
            <h1><a href="/vendaplus/vendas" style="text-decoration: none; color:#ddd";>VPlus</a></h1>
            <div id="header" class="d-flex flex-row align-items-center" style="width: auto;">
              <span id="spann" class="me-2">Olá, <p id="nome" class="fw-bold d-inline"> <?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Visitante'; ?></p></span>
              <a href="login" class="ms-auto">
                <button id="logout-btn" type="button" class="btn btn-warning">Sair</button>
              </a>
            </div>
        </div>
 
    <script>
        // fazer logout do sistema
        const logout = document.getElementById("logout-btn");

        logout.addEventListener("click", function(){
            
            fetch("app/controller/auth_controller.php?action=logout", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    console.log(data.message);
                    window.location.href = "login";
                }
                else{
                    console.log(data.message);
                }
            })
            .catch((error) =>{
                console.error("Fetch error: ", error);
            })
        });
    </script>

    <div class="container">
     