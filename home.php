<?php

session_start();

// Verifica se o e-mail está presente na sessão
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Certifique-se de que a sessão seja fechada
session_write_close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Seu cabeçalho aqui -->
</head>
<body>
    <!-- Adicione esta linha onde você deseja exibir o e-mail -->
    <span id="user-email"><?php echo $email; ?></span>
    
    <!-- Outro conteúdo da página -->

    <script>
        // Redirecionamento para home.html sem esperar
        window.location.href = "home.html";
    </script>
</body>
</html>