<?php
session_start();

// Exibir mensagens de erro do PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("criar-conexao-db.php");

    // Obtém os valores do formulário
    $servico = $_POST['servico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $mensagem = $_POST['mensagem'];

    // Validação básica
    if (empty($servico) || empty($data) || empty($horario)) {
        $agendamentoError = "Preencha todos os campos obrigatórios.";
    } else {
        // Recupera o e-mail do usuário da sessão
        $emailUsuario = $_SESSION['email'];
        $endereco = $_SESSION['enderecocompleto'];

        // Insere o agendamento no banco de dados com o e-mail do usuário
        $insereAgendamento = $conn->prepare("INSERT INTO tb_agendar_servico (tipo_servico, data_servico, horario_servico, mensagem, email_usuario, endereco_completo, agendamento) VALUES (?, ?, ?, ?, ?, ?, 'Não confirmado')");
        $insereAgendamento->bind_param("sssss", $servico, $data, $horario, $mensagem, $emailUsuario, $enderecoCompleto);
        $insereAgendamento->execute();

        // Verifica se o agendamento foi bem-sucedido
        if ($insereAgendamento->affected_rows === 1) {
            // Agendamento bem-sucedido, redireciona para a página de sucesso ou faz qualquer outra coisa que seja necessária
            echo '<p>Agendamento bem-sucedido. Redirecionando para a página de sucesso...</p>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "home.php";
                    }, 5000); // 5000 milissegundos = 5 segundos
                  </script>';
            exit();
        } else {
            $agendamentoError = "Erro ao agendar o serviço. Tente novamente.";
            // Redirecionamento para agendar-servico.html após 5 segundos
            echo '<p>Erro ao agendar o serviço. Tente novamente...</p>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "tela-agendar-servico.php";
                    }, 5000); // 5000 milissegundos = 5 segundos
                  </script>';
            exit();
        }

        $insereAgendamento->close();
    }

    // Exibição de mensagens de erro do MySQL
    if ($insereAgendamento->error) {
        echo "Erro MySQL: " . $insereAgendamento->error;
    }

    $conn->close();
}

// Exemplo de exibição de mensagem de erro
if (isset($agendamentoError)) {
    echo '<p style="color: red;">' . $agendamentoError . '</p>';
}
?>
