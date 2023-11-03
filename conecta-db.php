<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_limpa_ja";

// Criar uma conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

echo "Conexão bem-sucedida!";

// Você pode executar consultas aqui

// Feche a conexão quando terminar
$conn->close();
?>




