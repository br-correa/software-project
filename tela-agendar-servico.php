<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style-responsive.css">
    <title>Limpa Já! Agende seu serviço</title>
</head>
<body>
    <header class="header">
        <h1 class="header-title">Limpa Já!</h1>
    </header>
    
    <div class="container">      
                
        <form id="login-form" class="content" action="agendar-servico.php" method="POST">
            <h2 class="fieldset-label text-center">Agende seu serviço</h2><br>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" class="form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>
            </div>         

            <div class="form-group">
                <label for="servico">Tipo de Serviço:</label>
                <select id="servico" name="servico" class="form-control">
                    <option value="Lavar roupa">Lavar Roupa</option>
                    <option value="Passar roupa">Passar Roupa</option>
                    <option value="Limpar casa">Limpar Casa</option>
                    <!-- Adicione mais opções de serviço conforme necessário -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="data">Data do Serviço:</label>
                <input type="date" id="data" name="data" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="horario">Horário do Serviço:</label>
                <input type="time" id="horario" name="horario" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="mensagem">Mensagem Adicional:</label>
                <textarea id="mensagem" name="mensagem" rows="4" class="form-control"></textarea>
            </div>
            
            <div class="form-group text-center">                
                <button class="button-label" type="submit">Agendar</button>
            </div>
            
        </form>
    </div>
    
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="funcoes.js"></script>
    <script src="validacoes.js"></script>
</html>
