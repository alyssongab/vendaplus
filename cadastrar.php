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

<!-- Modal -->
<div class="modal fade" id="modalVenda" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Venda Registrada</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>A venda foi registrada com sucesso!</p>
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

    document.getElementById("form-venda").addEventListener("submit", function(event){
    event.preventDefault(); // Impede o envio padrão do formulário

    var modal = new bootstrap.Modal(document.getElementById('modalVenda'));
    modal.show();
    
    });
  <?php endif; ?>
</script>

