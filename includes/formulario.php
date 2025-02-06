<main>
    <section class="mt-3">
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3">Registrar venda</h2>


    <div class="form-container">
        <div class="form-wrapper">
            <form method="post">

                <!-- input produtos -->
                <div class="form-group mt-3">
                    <label for="produtos">Produtos:</label>
                    <textarea class="form-control" name="produtos" id="produtos" style="width: 50%;"></textarea>
                </div>

                <!-- input valor -->
                <div class="form-group mt-3">
                    <label for="valor">Valor:</label>
                    <input class="form-control" type="text" name="valor" id="valor" style="width: 50%;">
                </div>

                <!-- input cliente -->
                <div class="form-group mt-3">
                    <label for="cliente">Cliente:</label>
                    <input class="form-control" type="text" name="cliente" id="cliente" style="width: 50%;">
                </div>

                <!-- input status -->
                <div class="form-group mt-3">
                    <label>Status da venda</label>

                    <div>
                        <div class="px-0 form-check form-check-inline">
                            <label class="form-control">
                                <input type="radio" name="status" value="S">Pago
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <label class="form-control">
                                <input type="radio" name="status" value="N" checked>Pendente
                            </label>
                        </div>
                    </div>
                </div>
                         
                <!-- registrar a venda -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>

            </form>
        </div>
    </div>

</main>