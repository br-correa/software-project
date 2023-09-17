function redirecionarParaPaginaDeLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./login.html";
}

// Adicione um ouvinte de evento ao botão "Voltar"
document.getElementById("btn-voltar").addEventListener("click", redirecionarParaPaginaDeLogin);


function entrarLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./home.html";
}

// Adicione um ouvinte de evento ao botão "Entrar"
document.getElementById("btn-enviar").addEventListener("click", entrarLogin);

