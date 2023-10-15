function redirecionarParaPaginaDeLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./login.html";
}

// Adicione um ouvinte de evento ao botão "Voltar"
document.getElementById("btn-voltar").addEventListener("click", redirecionarParaPaginaDeLogin);

function validateAndRedirect() {
    // Obtenha os valores do campo de usuário e senha
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Faça uma requisição AJAX para verificar a autenticação no servidor (assumindo que você está usando um servidor para autenticação)
    // Aqui está um exemplo simples, você deve ajustá-lo para se adequar ao seu sistema de autenticação.
    $.ajax({
        type: "POST",
        url: "sua_api_de_autenticacao.php", // Substitua pela URL da sua API de autenticação
        data: {
            username: username,
            password: password
        },
        success: function (response) {
            // Se a autenticação for bem-sucedida, redirecione para a página home.html
            if (response === "autenticado") {
                window.location.href = "home.html";
            } else {
                // Caso contrário, exiba uma mensagem de erro
                alert("Nome de usuário ou senha incorretos. Tente novamente.");
            }
        },
        error: function (error) {
            // Lidar com erros de requisição, se necessário
            console.error("Erro na requisição: " + error);
        }
    });
}

