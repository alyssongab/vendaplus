<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

        .alert{
            display: none;
        }

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
            width: 35%;
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
                    <img src="app/assets/login.svg" alt="login-illustration">
                </div>             
            </div>
            <div id="img-container" class="col-md-6 d-flex flex-column justify-content-center text-center">
                <!-- titulo -->
                <span class="alert alert-danger" role="alert"></span>
                <div id="login-box" class="text-start px-3 row mt-3">
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
                        <button id="login-btn" type="button" class="btn btn-primary w-100">Entrar</button>
                     </div>
                </div>
            </div>
        </main>
    </div>
    <script>

        const login = document.getElementById('login-btn');
        const alerta = document.querySelector('.alert');

        login.addEventListener("click", function() {
            
            const email = document.getElementById("email").value.trim();
            const senha = document.getElementById("senha").value.trim();

            if (email === "" || senha === "") {
               alerta.style.display = "block";
               alerta.textContent = "Preencha todos os campos!";
               return;
            }

            fetch("app/controller/auth_controller.php?action=login", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({email: email, senha: senha})
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if(data.status){
                    console.log(data.message);
                    window.location.href = "/vendaplus/vendas"
                }
                else{
                    alerta.style.display = "block";
                    alerta.textContent = data.message
                }
            })
            .catch((error) => { // Corrigido o erro de sintaxe
                console.error("Fetch error: ", error);
                alertElement.style.display = "block"; // Exibe o alerta
                alertElement.textContent = "Erro durante o login. Tente novamente."; // Mensagem de erro
            });
        });

    </script>
</body>
</html>