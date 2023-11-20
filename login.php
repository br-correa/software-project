<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("criar-conexao-db.php");

    // Obtém os valores do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validação básica
    if (empty($email) || empty($password)) {
        $loginError = "Preencha todos os campos.";
    } else {
        // Consulta SQL usando instrução preparada
        $sql = "SELECT * FROM tb_cadastro_de_usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['senha'])) {
                $_SESSION['email'] = $email;

                $data_hora_login = date('Y-m-d H:i:s');
                $stmt = $conn->prepare("INSERT INTO tb_login (email, data_hora_login) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $data_hora_login);
                $stmt->execute();

                $stmt->close();
                $conn->close();
                header('Location: home.html');
                exit();
            } else {
                $loginError = "Credenciais incorretas. Tente novamente.";
            }
        } else {
            $loginError = "Credenciais incorretas. Tente novamente.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
