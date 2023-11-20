<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style-responsive.css">
    <title>Limpa Já! Deu preguiça é só chamar</title>
</head>
<body>
    <header class="header">
        <h1 class="header-title">Limpa Já!</h1>
    </header>

    <div class="container">
                                   
        <div class="content">              
                     
            <section class="schedule-section"></br>

                <h2 class="fieldset-label text-center">Meus Serviços Agendados</h2><br>
                
                <div class="button-container">
                    <button class="button" onclick="redirecionarParaAgendarServico('Lavar Roupas')">
                        <img src="lavar-roupa.jpeg" alt="Lavar Roupas" /></br>
                        <span>Lavar</span>
                    </button> 
                
                    <button class="button" onclick="redirecionarParaAgendarServico('Passar Roupas')">
                        <img src="passar-roupa.jpeg" alt="Passar Roupas" /></br>
                        <span>Passar</span>
                    </button> 
              
                    <button class="button" onclick="redirecionarParaAgendarServico('Limpar Casa')">
                        <img src="limpar-casa.jpeg" alt="Limpar Casa" /></br>
                        <span>Limpar</span>
                    </button>                                   
                </div>
            </section> 
            
            <section class="meus-servicos"></br>

                <div class="container">
                    <div class="content">

                        <h2 class="fieldset-label text-center">Bem-vindo à Página Inicial</h2><br>

                        <?php
                        // Verifique se o parâmetro de consulta 'email' está presente na URL
                        if (isset($_GET['email'])) {
                            // Se presente, exiba o email na página
                            $email = $_GET['email'];
                            echo '<p>Email: ' . htmlspecialchars($email) . '</p>';
                        } else {
                            // Se não presente, exiba uma mensagem padrão ou redirecione para o login
                            echo '<p>Email não disponível</p>';
                            
                            // ou redirecione para o login
                            header("Location: login.php");
                            exit();
                        }
                        ?>

                        <!-- Aqui você pode adicionar mais conteúdo HTML conforme necessário -->
            
                    </div>
                </div>
            </section> 
                       
            <div id="user-info" class="text-center"></br>                                   
                <!-- Adiciona o botão de logoff -->
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
            
        </div>
    </div>      
    
    
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="funcoes.js"></script>

</html>
