<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Exibe o e-mail salvo na sessão
echo '<p>Bem-vindo(a), ' . $_SESSION['email'] . '!</p>';
?>

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

    <h1>Bem-vindo à sua página inicial, <?php echo $_SESSION['email']; ?>!</h1>

    <div class="container">
                                   
        <div class="content">              
                     
            <section class="schedule-section"></br>

                <h2 class="fieldset-label text-center">Meus Serviços Agendados</h2><br>
                
                <div class="button-container">
                    <form action="redirect.php" method="post">
                        <button class="button" name="action" value="lavar">
                            <img src="lavar-roupa.jpeg" alt="Lavar Roupas" /><br/>
                            <span>Lavar</span>
                        </button>
                    </form>
                
                    <form action="redirect.php" method="post">
                        <button class="button" name="action" value="passar">
                            <img src="passar-roupa.jpeg" alt="Passar Roupas" /><br/>
                            <span>Passar</span>
                        </button>
                    </form>
                
                    <form action="redirect.php" method="post">
                        <button class="button" name="action" value="limpar">
                            <img src="limpar-casa.jpeg" alt="Limpar Casa" /><br/>
                            <span>Limpar</span>
                        </button>
                    </form>
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
