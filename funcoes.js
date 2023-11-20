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