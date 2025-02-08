<?php

require __DIR__.'/vendor/autoload.php';

$cadastroSucesso = false;

// valida os dados do post
if (isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])) {
    $cadastroSucesso = true;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
?>

<!-- modal de confirmação de registro -->
<div class="modal fade" id="modalVenda" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title">Venda Registrada</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>A venda foi registrada com sucesso!</p>
      </div>
      <div class="p-2" id="modal-subcontent">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php
include __DIR__.'/includes/footer.php';
?>

<script>
  <?php if ($cadastroSucesso): ?>
    
  const produtos = document.getElementById('produtos').value;
  const valor = parseFloat(document.getElementById('valor')).value;
  const cliente = document.getElementById('cliente').value;
  const status = document.getElementById('status').value;
  const data = {
    Produtos: produtos,
    Valor: valor,
    Cliente: cliente,
    Status: status
  };
  
  // resgata id do modal
  var modal = new bootstrap.Modal(document.getElementById('modalVenda'));
  var subcontent = document.getElementById('modal-subcontent');

  document.getElementById("form-venda").addEventListener("submit", function(event){
    event.preventDefault(); // Impede o envio padrão do formulário

    // Limpa o conteúdo anterior do modal
    subcontent.innerHTML = '';

    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        const value = data[key];
        const p = document.createElement('p'); // Cria um elemento <p>
        p.textContent = `${key}: ${value}`; // Define o texto do parágrafo
        subcontent.appendChild(p); // Adiciona o parágrafo à div subcontent
      }
    }

    modal.show();

  });
  <?php endif; ?>
</script>

