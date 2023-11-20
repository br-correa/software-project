function redirecionarParaPaginaDeLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./login.html";
}

// Adicione um ouvinte de evento ao botão "Voltar"
document.getElementById("btn-voltar").addEventListener("click", redirecionarParaPaginaDeLogin);

function redirecionarParaAgendarServico(tipoServico) {
    // Aqui você pode adicionar lógica adicional conforme necessário
    // Exemplo: redirecionar para a página de agendamento com base no tipo de serviço
    window.location.href = 'agendar-servico.html';
}

document.addEventListener('DOMContentLoaded', function() {
    // Recupere o email da sessão (você pode precisar ajustar se estiver usando algo diferente de PHP no servidor)
    var email = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";

    if (email) {
        document.getElementById('user-email').innerText = email;
    }
});