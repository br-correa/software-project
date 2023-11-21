<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Conexão com o banco de dados
include("criar-conexao-db.php");

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_servico'])) {
    $idServico = $_POST['id_servico'];

    // Atualiza o status do serviço para 'Confirmado'
    $stmt = $conn->prepare("UPDATE tb_agendar_servico AS a
                       JOIN tb_cadastro_de_usuarios AS u ON a.usuario_id = u.usuario_id
                       SET a.agendamento = 'Confirmado' 
                       WHERE a.servico_id = ?");
                       
    $stmt->bind_param("i", $idServico);

    if ($stmt->execute()) {
        // Atualização bem-sucedida
        header("Location: {$_SERVER['PHP_SELF']}"); // Redireciona para a mesma página para evitar o reenvio do formulário
        exit();
    } else {
        // Erro ao confirmar o serviço
        $confirmarErro = "Erro ao confirmar o serviço. Tente novamente.";
    }

    $stmt->close();
}

// Consulta SQL para obter os serviços pendentes de confirmação 
$sqlPendentes = "SELECT tb_agendar_servico.*, tb_cadastro_de_usuarios.nome AS nome_cliente, tb_cadastro_de_usuarios.endereco AS endereco_cliente 
                FROM tb_agendar_servico 
                JOIN tb_cadastro_de_usuarios ON tb_agendar_servico.usuario_id = tb_cadastro_de_usuarios.usuario_id
                WHERE tb_agendar_servico.agendamento = 'Não confirmado'";

$resultPendentes = $conn->query($sqlPendentes);

// Armazena os resultados em um array para exibição posterior
$agendamentosPendentes = [];
while ($rowPendente = $resultPendentes->fetch_assoc()) {
    $agendamentosPendentes[] = $rowPendente;
}

// Consulta SQL para obter os serviços confirmados
$sqlConfirmados = "SELECT * FROM tb_agendar_servico WHERE agendamento = 'Confirmado'";
$resultConfirmados = $conn->query($sqlConfirmados);

// Armazena os resultados em um array para exibição posterior
$agendamentosConfirmados = [];
while ($rowConfirmado = $resultConfirmados->fetch_assoc()) {
    $agendamentosConfirmados[] = $rowConfirmado;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style-responsive.css">
    <title>Limpa Já! Deu preguiça é só chamar</title>
</head>
<body>
    <header class="header">
        <h1 class="header-title">Limpa Já!</h1>
    </header>    

    <div class="container">                               
        <div class="content">  
            <h2 class="fieldset-label text-center">Seja bem-vindo <?php echo $_SESSION['nome']; ?>!</h2>
                                
            
            <section class="schedule-section">
                <h2 class="fieldset-label">Agendamentos pendentes</h2>

                <div class="button-container text-center">
                <?php if (!empty($agendamentosPendentes)): ?>

                    <table class="agendamentos-table">
                        <thead>
                            <tr>
                                <th>Tipo de Serviço</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Mensagem Adicional</th>
                                <th>Status</th>
                                <th>Cliente</th>
                                <th>Endereço</th>
                                <th>Ações</th> <!-- Nova coluna para o botão -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agendamentosPendentes as $agendamento): ?>
                                <tr>
                                    <td><?= $agendamento['tipo_servico'] ?></td>
                                    <td><?= $agendamento['data_servico'] ?></td>
                                    <td><?= $agendamento['horario_servico'] ?></td>
                                    <td><?= isset($agendamento['mensagem']) ? $agendamento['mensagem'] : '' ?></td>
                                    <td><?= $agendamento['agendamento'] ?></td>
                                    <td><?= $agendamento['nome_cliente'] ?></td>
                                    <td><?= $agendamento['endereco_cliente'] ?></td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="hidden" name="id_servico" value="<?= $agendamento['servico_id'] ?>">
                                            <button type="submit" class="btn btn-success" name="confirmar_servico">Confirmar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <p>Você confirmou todos os agendamentos pendentes. Obrigado!</p>
                <?php endif; ?>

                </div>
            </section>

            <section class="schedule-section">
                <h2 class="fieldset-label">Serviços Confirmados</h2>

                <div class="button-container text-center">
                <?php if (!empty($agendamentosConfirmados)): ?>

                    <table class="agendamentos-table">
                        <thead>
                            <tr>
                                <th>Tipo de Serviço</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Mensagem Adicional</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agendamentosConfirmados as $agendamento): ?>
                                <tr>
                                    <td><?= $agendamento['tipo_servico'] ?></td>
                                    <td><?= $agendamento['data_servico'] ?></td>
                                    <td><?= $agendamento['horario_servico'] ?></td>
                                    <td><?= isset($agendamento['mensagem']) ? $agendamento['mensagem'] : '' ?></td>
                                    <td><?= $agendamento['agendamento'] ?></td>                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                <?php else: ?>
                    <p>Você não possui nenhum serviço confirmado até o momento!</p>
                <?php endif; ?>

                </div>
            </section>

            <div id="user-info" class="text-center"></br>                                   
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
