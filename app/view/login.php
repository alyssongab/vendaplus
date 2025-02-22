<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container{
            width: 60%;
            margin: 0 auto; /* Adiciona margem automática horizontal */
            margin-top: 100px; /* Adiciona margem no topo para centralizar verticalmente (ajuste conforme necessário) */
        }

        #img-box{
            padding: 20px;
            display: flex; /* Enable flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin-top: 40px;
        }

        #login-box{
            width: 30%;
        }

        .btn{
            background-color: #5247FF;
        }

        .btn:hover{
            background-color:rgb(118, 108, 252);
        }

        #img-box img {
            max-width: 100%;
            height: 100%; 
        }

        @media(max-width: 1024px){
            label, input, button, ::placeholder{
                font-size: 0.9em;
            }

            #img-box img {
            margin-top: 20px;
            max-width: 100%;
            height: 100%; 
            }

            .container{
                width: 65%;
            }
        }

        @media (max-width: 768px) {

            .container{
                width: 70%;
            }

            .spn{
                display: block;
            }

            #img-box {
                display: none;
            }

            label, input, button, ::placeholder{
                font-size: 0.85em;
            }

        }

        @media (max-width: 480px){
            .container{
                width: 75%;
            }
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container bg-light rounded-3 p-4">
        <main class="row text-center">
            <div class="col-md-6">
                <div id="img-box" class="row">
                    <span class="spn" style="display: none;">Faça seu login</span>
                    <img src="../assets/login.svg" alt="login-illustration">
                </div>             
            </div>
            <div id="img-container" class="col-md-6 text-center">
                <!-- titulo -->
                <div id="login-box" class="row mt-3">
                    <h3 class="border-bottom border-primary-subtle">VPlus</h1>
                </div>
                <!-- form -->
                <div class="form-container mt-3 d-flex flex-column gap-4 text-start">
                    <!-- email -->
                    <div id="email-field" class="form-group">
                        <label for="email" class="px-1">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu email" required autocomplete="off">
                    </div>
                    <!-- senha -->
                    <div id="senha-field" class="form-group">
                        <label for="senha" class="px-1">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                    </div>
                    <!-- submit -->
                     <div class="form-group">
                        <button class="btn btn-primary w-100">Entrar</button>
                     </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>