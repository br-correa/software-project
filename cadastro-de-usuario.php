<?php
// Conexão com o banco de dados SQLite
$db = new SQLite3('db-software-project.db'); // Substitua pelo caminho correto

<<<<<<< Updated upstream
if (!$db) {
    die("Erro ao conectar ao banco de dados.");
}

=======
>>>>>>> Stashed changes
// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os valores do formulário
    $perfil = $_POST['perfil'];
    $lavar_roupa = isset($_POST['lavar_roupa']) ? 1 : 0;
    $passar_roupa = isset($_POST['passar_roupa']) ? 1 : 0;
    $limpar_casa = isset($_POST['limpar_casa']) ? 1 : 0;
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
    $stmt = $db->prepare("INSERT INTO 'cadastro-de-usuarios' (perfil, lavar_roupa, passar_roupa, limpar_casa, nome, sobrenome, apelido, data_nascimento, cpf, telefone, celular, cep, rua, numero, bairro, cidade, estado, email, senha) 
                         VALUES (:perfil, :lavar_roupa, :passar_roupa, :limpar_casa, :nome, :sobrenome, :apelido, :data_nascimento, :cpf, :telefone, :celular, :cep, :rua, :numero, :bairro, :cidade, :estado, :email, :senha)");
    
    $stmt->bindValue(':perfil', $perfil, SQLITE3_TEXT);
    $stmt->bindValue(':lavar_roupa', $lavar_roupa, SQLITE3_INTEGER);
    $stmt->bindValue(':passar_roupa', $passar_roupa, SQLITE3_INTEGER);
    $stmt->bindValue(':limpar_casa', $limpar_casa, SQLITE3_INTEGER);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':sobrenome', $sobrenome, SQLITE3_TEXT);
    $stmt->bindValue(':apelido', $apelido, SQLITE3_TEXT);
    $stmt->bindValue(':data_nascimento', $data_nascimento, SQLITE3_TEXT);
    $stmt->bindValue(':cpf', $cpf, SQLITE3_TEXT);
    $stmt->bindValue(':telefone', $telefone, SQLITE3_TEXT);
    $stmt->bindValue(':celular', $celular, SQLITE3_TEXT);
    $stmt->bindValue(':cep', $cep, SQLITE3_TEXT);
    $stmt->bindValue(':rua', $rua, SQLITE3_TEXT);
    $stmt->bindValue(':numero', $numero, SQLITE3_TEXT);
    $stmt->bindValue(':bairro', $bairro, SQLITE3_TEXT);
    $stmt->bindValue(':cidade', $cidade, SQLITE3_TEXT);
    $stmt->bindValue(':estado', $estado, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':senha', $senha, SQLITE3_TEXT);
    
    $result = $stmt->execute();

    if ($result) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro ao inserir o registro.";
    }
}
?>
