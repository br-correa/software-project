<?php
// Conexão com o banco de dados MySQL
include("criar-conexao-db.php");

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os valores do formulário
    $perfil = $_POST['perfil'];

    // Padrão para o serviço 'lavar-roupa'
    if (isset($_POST['servico']) && is_array($_POST['servico']) && in_array('lavar-roupa', $_POST['servico'])) {
        $lavar_roupa = 1;
    } else {
        $lavar_roupa = 0;
    }

    // Padrão para o serviço 'passar-roupa'
    if (isset($_POST['servico']) && is_array($_POST['servico']) && in_array('passar-roupa', $_POST['servico'])) {
        $passar_roupa = 1;
    } else {
        $passar_roupa = 0;
    }

    // Padrão para o serviço 'limpar-casa'
    if (isset($_POST['servico']) && is_array($_POST['servico']) && in_array('limpar-casa', $_POST['servico'])) {
        $limpar_casa = 1;
    } else {
        $limpar_casa = 0;
    }

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $apelido = $_POST['apelido'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = preg_replace('/\D/', '', $_POST['cpf']); // Remove caracteres não numéricos
    $telefone = preg_replace('/\D/', '', $_POST['telefone']); // Remove caracteres não numéricos
    $celular = preg_replace('/\D/', '', $_POST['celular']); // Remove caracteres não numéricos
    $cep = preg_replace('/\D/', '', $_POST['cep']); // Remove caracteres não numéricos
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

    // Insere os dados na tabela de usuários
    $stmt = $conn->prepare("INSERT INTO tb_cadastro_de_usuarios (perfil, lavar_roupa, passar_roupa, limpar_casa, nome, sobrenome, apelido, data_nascimento, cpf, telefone, celular, cep, rua, numero, bairro, cidade, estado, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("siisssssssssssssss", $perfil, $lavar_roupa, $passar_roupa, $limpar_casa, $nome, $sobrenome, $apelido, $data_nascimento, $cpf, $telefone, $celular, $cep, $rua, $numero, $bairro, $cidade, $estado, $email, $senha);

    if ($stmt->execute()) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro ao inserir o registro: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
