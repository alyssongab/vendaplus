<main>

    <section class="mt-3">
        <a href="/vendaplus/venda">
            <button class="btn btn-success">Nova venda</button>
        </a>
    </section>

    <section id="listagem" class="mt-3 container">
        <table id="tabela-vendas" class="table">
            <thead>
                <tr>
                    <th scope="col">Data da venda</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Produtos</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
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
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${venda.data_venda}</td>
                    <td>${venda.cliente}</td>
                    <td>${venda.produtos}</td>
                    <td>${venda.valor}</td>
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
