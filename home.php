<?php
session_start(); // Inicie a sessão para lidar com as variáveis de sessão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi enviado

    // Conexão com o banco de dados
    include("criar-conexao-db.php");

    // Obtém os valores do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM tb_cadastro_de_usuarios WHERE email = ? AND senha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // As credenciais estão corretas, o usuário está logado
        $_SESSION['email'] = $email;

        // Inserir um registro de login na tabela tb_login
        $data_hora_login = date('Y-m-d H:i:s'); // Obtém a data e hora atuais
        $stmt = $conn->prepare("INSERT INTO tb_login (email, data_hora_login) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $data_hora_login);
        $stmt->execute();
        
        $stmt->close();

        $conn->close();
        header('Location: home.php'); // Redireciona para a página de painel do usuário
        exit(); // Certifique-se de sair após redirecionar
    } else {
        // Credenciais incorretas
        $loginError = "Credenciais incorretas. Tente novamente.";
    }

    $stmt->close();
    $conn->close();
}
?>
