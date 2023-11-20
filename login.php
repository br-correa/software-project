<?php
session_start();

// Exibir mensagens de erro do PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
            // Verifica se a senha fornecida corresponde à senha no banco de dados
            if ($password === $row['senha']) {
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['perfil'] = $row['perfil'];

                $data_hora_login = date('Y-m-d H:i:s');
                $stmt = $conn->prepare("INSERT INTO tb_login (email, data_hora_login) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $data_hora_login);
                $stmt->execute();

                $stmt->close();
                $conn->close();

                // Teste de redirecionamento
                echo '<p>Login bem-sucedido! Redirecionando para home.html...</p>';

                // Após o login bem-sucedido
                $_SESSION['email'] = $email;

                // Certifique-se de que a sessão seja salva antes de redirecionar
                session_write_close();

                // Exibição do email antes do redirecionamento (apenas para depuração)
                echo '<p>Email salvo na sessão: ' . $_SESSION['email'] . '</p>';
                echo '<p>Nome salvo na sessão: ' . $_SESSION['nome'] . '</p>';
                echo '<p>Perfil salvo na sessão: ' . $_SESSION['perfil'] . '</p>';

                // Verifique o tipo de perfil e redirecione para a página apropriada
                if ($_SESSION['perfil'] == 'cliente') {

                    echo '<script>
                    setTimeout(function() {
                        window.location.href = "home.php?email=' . urlencode($email) . '";
                    }, 5000);
                    </script>';
                    exit();

                } elseif ($_SESSION['perfil'] == 'prestador') {

                    echo '<script>
                    setTimeout(function() {
                        window.location.href = "home-prestador.php?email=' . urlencode($email) . '";
                    }, 5000);
                    </script>';
                    exit();

                } else {

                    // Redirecionamento padrão
                    echo '<script>
                    setTimeout(function() {
                        window.location.href = "home.php?email=' . urlencode($email) . '";
                    }, 5000);
                    </script>';
                    exit();

                }


                // Adicione um atraso de 5 segundos usando JavaScript
                echo '<script>
                setTimeout(function() {
                    window.location.href = "home.php?email=' . urlencode($email) . '";
                }, 5000);
                </script>';
                exit();

            } else {
                $loginError = "Credenciais incorretas. Tente novamente.";
                // Redirecionamento para login.html após 5 segundos
                echo '<p>Credenciais incorretas. Redirecionando para login.html...</p>';
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "login.html";
                        }, 5000); // 5000 milissegundos = 5 segundos
                      </script>';
                exit();
            }
        } else {
            $loginError = "Credenciais incorretas. Tente novamente.";
            // Redirecionamento para login.html após 5 segundos
            echo '<p>Credenciais incorretas. Redirecionando para login.html...</p>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "login.html";
                    }, 5000); // 5000 milissegundos = 5 segundos
                  </script>';
            exit();
        }
    }

    // Exibição de mensagens de erro do MySQL
    if ($stmt->error) {
        echo "Erro MySQL: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Exemplo de exibição de mensagem de erro
if (isset($loginError)) {
    echo '<p style="color: red;">' . $loginError . '</p>';
}
?>
