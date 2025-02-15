<main>

    <section class="mt-3">
        <a href="/vendaplus/venda">
            <button class="btn btn-success">Nova venda</button>
        </a>
    </section>

    <section id="listagem" class="mt-3 table-container">
        <!-- tabela -->
        <div class="table-responsive">
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
        <div id="pagination" class="pagination"></div>
    </section>

</main>

<script>
    let paginaAtual = 1

    function listarVendas(page = 1){
        const tbody = document.querySelector('tbody');
        fetch(`app/controller/lista_controller.php?page=${page}`, {
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
                row.innerHTML = `
                    <td>${venda.data_venda}</td>
                    <td>${venda.cliente}</td>
                    <td>${venda.produtos}</td>
                    <td>R$ ${venda.valor}</td>
                    <td>
                        <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pago-${venda.id_venda}" autocomplete="off" value="S" ${pago}>
                        <label id="S" class="btn btn-outline-success labelz" for="pago-${venda.id_venda}">Pago</label>

                        <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pendente-${venda.id_venda}" autocomplete="off" value="N" ${pendente}>
                        <label id="N" class="btn btn-outline-danger labelz" for="pendente-${venda.id_venda}">Pendente</label>
                    </td>
                `;
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
            }
        })
        .catch(error => {
            console.log("Erro: ", error);
        });
    
    }

    window.onload = () => listarVendas();

</script>
