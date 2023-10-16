<?php
// Conectar ao banco de dados (substitua as credenciais do banco de dados)
$servername = "seuservidordobanco";
$username = "seunome";
$password = "suasenha";
$dbname = "NomeDoBancoDeDados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Receber os valores do formulário de login
$email = $_POST['email'];
$senha = $_POST['senha']; // Lembre-se de armazenar senhas de forma segura (hash e salting)

// Consultar a tabela cadastro-de-usuario
$sql = "SELECT * FROM cadastro_de_usuario WHERE email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Usuário encontrado, verifique a senha
    $row = $result->fetch_assoc();
    $hashed_password = $row['senha']; // Recupere a senha hash armazenada no banco

    if (password_verify($senha, $hashed_password)) {
        // Senha correta, login bem-sucedido
        session_start();
        $_SESSION['usuario_id'] = $row['id']; // Você pode armazenar outros dados da sessão, se necessário
        header("Location: painel-de-controle.php"); // Redirecionar para o painel de controle
    } else {
        // Senha incorreta
        echo "Senha incorreta. Tente novamente.";
    }
} else {
    // Usuário não encontrado
    echo "Usuário não encontrado. Verifique o e-mail e a senha.";
}

$conn->close();
?>
