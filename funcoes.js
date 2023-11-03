function redirecionarParaPaginaDeLogin() {
    // Redireciona o usuário para a página de login
    window.location.href = "./login.html";
}

// Adicione um ouvinte de evento ao botão "Voltar"
document.getElementById("btn-voltar").addEventListener("click", redirecionarParaPaginaDeLogin);

// Rotina de login
function validateAndRedirect() {
    // Obtenha os valores do campo de usuário e senha
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;

    // Faça uma requisição AJAX para o arquivo PHP de autenticação
    $.ajax({
        type: "POST",
        url: "login.php", // Substitua pelo nome correto do seu arquivo PHP de autenticação
        data: {
            email: email,
            senha: senha
        },
        success: function (response) {
            // Se a autenticação for bem-sucedida, redirecione para a página desejada (por exemplo, "dashboard.php")
            if (response === "autenticado") {
                window.location.href = "home.html"; // Substitua pelo nome da página que deseja redirecionar após o login
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

