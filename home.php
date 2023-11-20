<?php

session_start();

// Verifica se o e-mail está presente na sessão
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Certifique-se de que a sessão seja fechada
session_write_close();

?>
