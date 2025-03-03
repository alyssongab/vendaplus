<?php require_once '../includes/header.php';?>

<main class="mb-5">
    
    <section class="mt-3">
        <a href="/vendaplus/vendas">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section> 

    <div class="text-light container d-flex flex-column justify-content-center align-items-center">
        <h2>Registrar venda</h2>

        <!-- Container do formulário -->
        <div class="form-container w-50 w-sm-75 w-md-50 w-lg-35 w-xl-25">
           
            <form id="form-venda" method="post" class="d-flex flex-column gap-3">    

                <!-- input produtos -->
                <div class="form-group ">
                    <label for="produtos">Produtos:</label>
                    <textarea class="form-control" name="produtos" id="produtos" placeholder="Egeo, Hidratante Deleite, etc." required></textarea>
                </div>

                <!-- input valor -->
                <div class="form-group ">
                    <label for="valor">Valor:</label>
                    <input class="form-control" type="text" name="valor" id="valor" placeholder="R$" required>
                </div>

                <!-- input cliente -->
                <div class="form-group ">
                    <label for="cliente">Cliente:</label>
                    <input class="form-control" type="text" name="cliente" id="cliente" required>
                </div>

                <!-- input status -->
                <div class="form-group ">
                    <label>Status da venda</label>
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusPago" value="S">
                            <label class="form-check-label" for="statusPago">Pago</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusPendente" value="N" checked>
                            <label class="form-check-label" for="statusPendente">Pendente</label>
                        </div>
                    </div>
                </div>
                        
                <!-- registrar a venda -->
                <div class="form-group ">
                    <button id="registrar" type="button" class="btn btn-success">Registrar</button>
                </div>

            </form>
        </div>
   
    </div>
</main>