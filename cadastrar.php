<?php

require __DIR__.'/vendor/autoload.php';

$cadastroSucesso = false;

// valida os dados do post
if (isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])) {
    $cadastroSucesso = true;
    $data = ['erro' => 'Campos obrigatórios não preenchidos'];
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
?>

<!-- modal de confirmação de registro -->
<div class="modal fade" id="modalVenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
        <button id="close-modal" type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php
include __DIR__.'/includes/footer.php';
?>

<script>

  const btn = document.getElementById('registrar');
  const form = document.getElementById('form-venda');
  const close = document.getElementById('close-modal');
  
  btn.addEventListener("click", function(e){
    e.preventDefault();
    
    const formData = new FormData(form);

    fetch('processa_venda.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json()) // transforma a resposta em json
    .then(data => {
      console.log(data);
      const modal = new bootstrap.Modal(document.getElementById('modalVenda'));
      const subcontent = document.getElementById('modal-subcontent');

      subcontent.innerHTML = ''; // limpa o conteudo anterior

      // mostra a chave e valor dos dados recebidos
      if(data.cadastroSucesso){
        for(const key in data.data){
          const value = data.data[key];
          const p = document.createElement('p');
          p.textContent = `${key}: ${value}`;
          subcontent.appendChild(p);
        }
        modal.show();
        // Redireciona após mostrar o modal
        setTimeout(() => {
        window.location.href = "index.php?status=success";
        }, 2000);

      }
      else{
        subcontent.innerHTML = '<p>Erro ao registrar venda</p>';
        modal.show();
      }
    })
    .catch(error => {
      console.error('Erro: ', error);
      const modal = new bootstrap.Modal(document.getElementById('modalVenda'));
      const subcontent = document.getElementById('modal-subcontent');
      subcontent.innerHTML = '<p>Erro ao processar requisição</p>';
    })

  });

  // recarrega a pagina depois de registrar a venda
  close.addEventListener("click", function(){
    window.location.reload();
  })
</script>

