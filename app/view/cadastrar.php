<?php
session_start();
require_once '../includes/header.php';

$cadastroSucesso = true;

// valida os dados do post
if (!isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])) {
    $cadastroSucesso = false;
    $data = ['erro' => 'Campos obrigatórios não preenchidos'];
}

include __DIR__.'/../view/formulario.php';
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
        <p id="msg-sucesso"></p>
      </div>
      <div class="p-3" id="modal-subcontent">
        <p></p>
      </div>
      <div class="modal-footer">
        <button id="close-modal" type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php
include __DIR__.'/../includes/footer.php';
?>

<script>

  const btn = document.getElementById('registrar');
  const form = document.getElementById('form-venda');
  const close = document.getElementById('close-modal');
  
  btn.addEventListener("click", function(e){
    e.preventDefault();
    
    const formData = new FormData(form);

        // pega o valor
        let valor = formData.get('valor');

        // substitui o ponto por virgula
        valor = valor.replace(',', '.');

        // atualiza o valor para enviar ao backend
        formData.set('valor', valor);

    fetch('app/controller/processa_venda.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json()) // transforma a resposta em json
    .then(data => {
      console.log(data);
      const modal = new bootstrap.Modal(document.getElementById('modalVenda'));
      const subcontent = document.getElementById('modal-subcontent');
      const msg = document.getElementById('msg-sucesso');

      subcontent.innerHTML = ''; // limpa o conteudo anterior

      // mostra a chave e valor dos dados recebidos
      if(data.cadastroSucesso){
        msg.textContent = 'A venda foi registrada com sucesso!'
        for(let key in data.data){
          let value = data.data[key];

          // modifica o valor do status para "Pago" ou "Pagamento pendente"
          if (key === 'Status_venda') {
            key = 'Status da venda';
            value = value === 'S' ? 'Pago' : 'Pagamento pendente';
          }

          const p = document.createElement('p');
          p.textContent = `${key}: ${value}`;
          subcontent.appendChild(p);
        }
        modal.show();

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
    form.reset();
  })
</script>

<?php require_once ('../includes/footer.php') ?>