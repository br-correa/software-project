<?php
// confirmar_servico.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_servico'])) {
    // Conexão com o banco de dados
    include("criar-conexao-db.php");

    // Obtenha o id_servico da requisição POST
    $idServico = $_POST['id_servico'];

    // Atualize o status do serviço para 'Confirmado' (ou o que for apropriado)
    $stmt = $conn->prepare("UPDATE tb_agendar_servico SET agendamento = 'Confirmado' WHERE id_servico = ?");
    $stmt->bind_param("i", $idServico);

    if ($stmt->execute()) {
        echo 'success'; // Resposta bem-sucedida para a requisição AJAX
    } else {
        echo 'error'; // Resposta de erro para a requisição AJAX
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error'; // Resposta de erro para a requisição AJAX
}
?>
