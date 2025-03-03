<?php session_start(); require_once '../includes/header.php';?>
<main>

    <section id="above-table" class="mt-3 d-flex align-items-center justify-content-between">
        <a href="/vendaplus/venda" style="text-decoration: none;">
            <button id="nova-venda" class="btn btn-success"> + Nova venda</button>
        </a>
        <div id="pesquisa-area" class="form-group d-flex gap-1">
            <input id="pesquisa-input" type="text" class="form-control" placeholder="Pesquisar por cliente">
            <button id="pesquisa" type="button" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                </svg>
                <span id="pesquisar-span">Pesquisar</span>
              </button>
        </div>
    </section>

    <section id="listagem" class="mt-3 table-container">
        <!-- tabela -->
        <div class="table-responsive" style="min-height: 350px;">
            <table id="tabela-vendas" class="table table-striped table-bordered table-hover text-center align-middle text-break">
                <thead class="table-info">
                    <tr>
                        <th scope="col">Data da venda</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Produtos</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status da venda</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <div class="pagination-container d-flex flex-column align-items-end mb-4">
            <div id="pagination" class="pagination"></div>
            <p class="text-light pt-1" id="pag"></p>
        </div>
    </section>

</main>

<script>
    let paginaAtual = 1
    const registrosPorPagina = 5; // Defina o número máximo de registros que você quer exibir
    const alturaLinha = 40; // Altura aproximada de cada linha da tabela
    const whichPage = document.getElementById("pag");
    
    // botao para pesquisar cliente
    const pesquisaInput = document.getElementById("pesquisa-input");
    const pesquisaButton = document.getElementById("pesquisa");

    function listarVendas(page = 1, customerName = null){
        const tbody = document.querySelector('tbody');
        let url = `app/controller/lista_controller.php?page=${page}`;
        if(customerName){
            url += `&customerName=${customerName}`;
        }
        fetch(url, {
            method: 'GET',
            headers: {
            'Content-Type': 'application/json'
             }
        })
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = '';

            // itera os dados recebidos e adiciona novas linhas na tabela
            data.vendas.forEach(venda => {
                // variaveis para o input radio
                let pago = venda.status_venda === 'Pago' ? "checked" : "";
                let pendente = venda.status_venda === 'Pagamento pendente' ? "checked" : "";
                const row = document.createElement('tr');
     
                if(venda != null){
                    row.innerHTML = `
                        <td data-label="Data da venda">${venda.data_venda}</td>
                        <td data-label="Cliente">${venda.cliente}</td>
                        <td data-label="Produtos">${venda.produtos}</td>
                        <td data-label="Valor">R$ ${venda.valor}</td>
                        <td data-label="Status da venda">
                            <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pago-${venda.id_venda}" autocomplete="off" value="S" ${pago}>
                            <label id="S" class="btn btn-outline-success labelz" for="pago-${venda.id_venda}">Pago</label>

                            <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pendente-${venda.id_venda}" autocomplete="off" value="N" ${pendente}>
                            <label id="N" class="btn btn-outline-danger labelz" for="pendente-${venda.id_venda}">Pendente</label>
                        </td>
                    `;
                }
                else{
                    row.innerHTML=`
                        <p class="text-center"> Não há vendas cadastradas no sistema. </p>
                    `
                }
                
                tbody.appendChild(row);
            });
            
            const radios = document.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.addEventListener('change', function(){
                    // corta 'venda' do name paga pegar apenas o id e mandar pro backend
                    const idVenda = this.name.replace('venda-', '');
                    // pega o value do status (Pago ou Pag. Pendente)
                    const statusVenda = this.value;
                    fetch('app/controller/edita_controller.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_venda: idVenda,
                            status_venda: statusVenda
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            console.log('status atualizado', data);
                        }
                        if(data.erro){
                            console.log('erro: ', data.erro);
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao atualizar o status:', error);
                    });
                })
            })

            // atualiza a paginação
            const pagination = document.querySelector("#pagination");
            pagination.innerHTML = '';
            for(let i = 1; i <= data.totalPaginas; i++){
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.innerText = i;
                pageLink.classList.add('page-link');
                if(i === data.paginaAtual){
                    pageLink.classList.add('active');
                }
                pageLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    listarVendas(i);
                })
                pagination.appendChild(pageLink);
                whichPage.textContent = `Mostrando página ${data.paginaAtual} de ${data.totalPaginas}`;
            }
        })
        .catch(error => {
            console.log("Erro: ", error);
        });
    
    }

    pesquisaButton.addEventListener('click', () => {
        const customerName = pesquisaInput.value;
        listarVendas(1, customerName);
    });

    window.onload = () => listarVendas();

</script>

<?php require_once '../includes/footer.php';  ?>