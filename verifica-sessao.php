<?php
// Inicie a sessão para acessar as variáveis de sessão
session_start();

// Verifique se a sessão contém o e-mail do usuário
if (!isset($_SESSION['email'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header("Location: login.html");
    exit();
}

$usuarioLogado = $_SESSION['email'];
?>