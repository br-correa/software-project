<?php
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login ou outra página desejada
header("Location: home.html"); // Substitua "login.php" pelo nome da sua página de login
exit();
?>
