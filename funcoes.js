function redirecionarParaPaginaDeLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./login.html";
}

// Adicione um ouvinte de evento ao botão "Voltar"
document.getElementById("btn-voltar").addEventListener("click", redirecionarParaPaginaDeLogin);

function confirmarServico(idServico) {
    $.ajax({
        url: 'confirmar_servico.php', // Página no servidor que lida com a confirmação
        type: 'POST', // Método de requisição HTTP
        data: { id_servico: idServico }, // Dados a serem enviados ao servidor
        success: function(response) {
            // Lógica para lidar com a resposta do servidor após a confirmação
            if (response === 'success') {
                // Atualizar a tabela ou fazer qualquer ação necessária
                alert('Serviço confirmado com sucesso!');
                location.reload(); // Recarregar a página para atualizar a tabela
            } else {
                alert('Erro ao confirmar serviço. Tente novamente.');
            }
        },
        error: function() {
            alert('Erro de comunicação com o servidor. Tente novamente.');
        }
    });
}