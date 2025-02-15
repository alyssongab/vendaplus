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
    </section>

</main>

<script>

    function listarVendas(){
        const tbody = document.querySelector('tbody');
        fetch("app/controller/lista_controller.php", {
            method: 'GET',
            headers: {
            'Content-Type': 'application/json'
             }
        })
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = '';

            // itera os dados recebidos e adiciona novas linhas na tabela
            data.forEach(venda => {
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
                        <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pago-${venda.id_venda}" autocomplete="off" ${pago}>
                        <label class="btn btn-outline-success" for="pago-${venda.id_venda}">Pago</label>

                        <input type="radio" class="btn-check" name="venda-${venda.id_venda}" id="pendente-${venda.id_venda}" autocomplete="off" ${pendente}>
                        <label class="btn btn-outline-danger" for="pendente-${venda.id_venda}">Pendente</label>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.log("Erro: ", error);
        });
    
    }

    window.onload = listarVendas();

</script>
