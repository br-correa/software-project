//cpf
document.addEventListener("DOMContentLoaded", function () {
    const cpfInput = document.getElementById("cpf");

    if (cpfInput) {
        cpfInput.addEventListener("input", function () {
            // Remove todos os caracteres não numéricos
            const cleanedValue = this.value.replace(/\D/g, "");

            // Aplica a máscara ao valor limpo
            let maskedValue = "";
            for (let i = 0; i < cleanedValue.length; i++) {
                if (i === 3 || i === 6) {
                    maskedValue += ".";
                } else if (i === 9) {
                    maskedValue += "-";
                }
                maskedValue += cleanedValue.charAt(i);
            }

            // Define o valor formatado no campo
            this.value = maskedValue;
        });
    }
});

//nome e sobrenome
document.addEventListener("DOMContentLoaded", function () {
    const nomeInput = document.getElementById("nome");
    const sobrenomeInput = document.getElementById("sobrenome");

    if (nomeInput) {
        nomeInput.addEventListener("input", function () {
            // Remove todos os números do valor inserido
            this.value = this.value.replace(/\d/g, "");
        });
    }

    if (sobrenomeInput) {
        sobrenomeInput.addEventListener("input", function () {
            // Remove todos os números do valor inserido
            this.value = this.value.replace(/\d/g, "");
        });
    }
});

//telefone e celular
document.addEventListener("DOMContentLoaded", function () {
    const telefoneInput = document.getElementById("telefone");
    const celularInput = document.getElementById("celular");

    function aplicarMascara(inputElement, mascara) {
        if (inputElement) {
            inputElement.addEventListener("input", function () {
                const cleanedValue = this.value.replace(/\D/g, "");
                let maskedValue = "";

                for (let i = 0, j = 0; i < mascara.length; i++) {
                    if (mascara[i] === "9") {
                        if (j < cleanedValue.length) {
                            maskedValue += cleanedValue[j];
                            j++;
                        } else {
                            // Se não houver mais números para preencher, pare de adicionar espaços
                            break;
                        }
                    } else {
                        maskedValue += mascara[i];
                    }
                }

                this.value = maskedValue;

                // Verificar se o campo está vazio e exibir o placeholder
                if (cleanedValue.length === 0) {
                    this.value = "";
                }
            });

            // Adicione este evento para manter o cursor no lugar correto ao excluir caracteres
            inputElement.addEventListener("keydown", function (event) {
                if (event.key === "Backspace") {
                    const selectionStart = this.selectionStart;
                    const selectionEnd = this.selectionEnd;

                    if (selectionStart === selectionEnd && selectionStart > 0 && this.value[selectionStart - 1] === " ") {
                        event.preventDefault();
                        this.setSelectionRange(selectionStart - 1, selectionStart - 1);
                    }
                }
            });
        }
    }

    // Aplicar máscara ao campo de telefone
    aplicarMascara(telefoneInput, "(99) 9999-9999");

    // Aplicar máscara ao campo de celular
    aplicarMascara(celularInput, "(99) 99999-9999");
});

// Função para validar e-mails
function validarEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return regex.test(email);
}

document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const erroEmail = document.getElementById("erro-email");

    emailInput.addEventListener("blur", function () {
        if (!validarEmail(this.value)) {
            erroEmail.textContent = "E-mail inválido";
        } else {
            erroEmail.textContent = "";
        }
    });

    // Aplicar máscara para converter o texto em letras minúsculas
    emailInput.addEventListener("input", function () {
        this.value = this.value.toLowerCase();
    });
});

//senha e confirmar-senha
document.addEventListener("DOMContentLoaded", function () {
    const senhaInput = document.getElementById("senha");
    const confirmarSenhaInput = document.getElementById("confirmar-senha");
    const erroSenha = document.getElementById("erro-senha");
    const erroConfirmarSenha = document.getElementById("erro-confirmar-senha");
    const formulario = document.getElementById("formulario");

    senhaInput.addEventListener("input", validarSenha);

    function validarSenha() {
        const senha = senhaInput.value;
        const confirmarSenha = confirmarSenhaInput.value;

        // Verificar se a senha atende aos critérios de senha forte
        const senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!senha.match(senhaForte)) {
            erroSenha.textContent = "A senha deve conter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um número.";
            erroConfirmarSenha.textContent = "";
            senhaInput.setCustomValidity("invalid");
        } else {
            erroSenha.textContent = "";
            senhaInput.setCustomValidity("");
        }

        // Validar a confirmação de senha após o usuário digitar a senha
        if (confirmarSenha) {
            if (senha !== confirmarSenha) {
                erroConfirmarSenha.textContent = "As senhas não coincidem.";
                confirmarSenhaInput.setCustomValidity("invalid");
            } else {
                erroConfirmarSenha.textContent = "";
                confirmarSenhaInput.setCustomValidity("");
            }
        }
    }

    confirmarSenhaInput.addEventListener("blur", function () {
        validarSenha();
    });

    formulario.addEventListener("submit", function (event) {
        validarSenha();
        if (formulario.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        formulario.classList.add("was-validated");
    });
});

//cep
document.addEventListener("DOMContentLoaded", function () {
    const cepInput = document.getElementById("cep");

    if (cepInput) {
        cepInput.addEventListener("input", function () {
            // Remove todos os caracteres não numéricos
            const cleanedValue = this.value.replace(/\D/g, "");

            // Aplica a máscara ao valor limpo
            let maskedValue = "";
            for (let i = 0; i < cleanedValue.length; i++) {
                if (i === 5) {
                    maskedValue += "-";
                }
                maskedValue += cleanedValue.charAt(i);
            }

            // Define o valor formatado no campo
            this.value = maskedValue;
        });
    }
});

// Função para configurar o comportamento do tipo de perfil
function configurarComportamentoPerfil() {
    var prestadorCheckbox = $("#prestador");
    var opcoesServico = $("#opcoes-servico");

    prestadorCheckbox.change(function () {
        if (this.checked) {
            opcoesServico.show();
        } else {
            opcoesServico.hide();
        }
    });

    // Verifique o estado inicial ao carregar a página
    opcoesServico.css("display", prestadorCheckbox.prop("checked") ? "block" : "none");

    // Limpar opções de serviço ao selecionar "Cliente"
    $("input[value='cliente']").change(function () {
        if (this.checked) {
            prestadorCheckbox.prop("checked", false);
            opcoesServico.hide();
        }
    });
}

// Função para validar o aceite dos termos de uso
function validarAceiteTermos() {
    const aceiteTermos = document.getElementById("aceite-termos");
    const btnEnviar = document.getElementById("btn-enviar");

    aceiteTermos.addEventListener("change", function () {
        btnEnviar.disabled = !aceiteTermos.checked;
    });
}

// Função para buscar CEP usando a API do ViaCEP
let cepTimeout;

function handleCepInput() {
    clearTimeout(cepTimeout); // Limpa o timeout anterior
    
    limparEndereco(); // Limpa os campos de endereço

    cepTimeout = setTimeout(function () {
        buscarCep();
    }, 1000); // Aguarda 1 segundo após a entrada do usuário antes de chamar a função buscarCep()
}

function buscarCep() {
    const cepInput = document.getElementById("cep").value;
    const ruaInput = document.getElementById("rua");
    const bairroInput = document.getElementById("bairro");
    const cidadeInput = document.getElementById("cidade");
    const estadoInput = document.getElementById("estado");

    // Limpar campos de erro
    document.getElementById("erro-cep").textContent = "";
    document.getElementById("erro-rua").textContent = "";
    document.getElementById("erro-bairro").textContent = "";
    document.getElementById("erro-cidade").textContent = "";
    document.getElementById("erro-estado").textContent = "";

    fetch(`https://viacep.com.br/ws/${cepInput}/json/`)
        .then((response) => response.json())
        .then((data) => {
            if (data.erro) {
                document.getElementById("erro-cep").textContent = "-> CEP não encontrado.";
            } else {
                ruaInput.value = data.logradouro;
                bairroInput.value = data.bairro;
                cidadeInput.value = data.localidade;
                estadoInput.value = data.uf;
            }
        })
        .catch((error) => {
            console.error("Erro ao buscar CEP:", error);
        });
}

// Função para limpar endereço
function limparEndereco() {
    const ruaInput = document.getElementById("rua");
    const bairroInput = document.getElementById("bairro");
    const cidadeInput = document.getElementById("cidade");
    const estadoInput = document.getElementById("estado");

    ruaInput.value = "";
    bairroInput.value = "";
    cidadeInput.value = "";
    estadoInput.value = "";

    // Limpar campos de erro, se houver
    document.getElementById("erro-rua").textContent = "";
    document.getElementById("erro-bairro").textContent = "";
    document.getElementById("erro-cidade").textContent = "";
    document.getElementById("erro-estado").textContent = "";
}

// Função para adicionar siglas dos estados ao campo de seleção
function adicionarEstados() {
    const estados = [
        "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO"
    ];

    const selectEstado = document.getElementById("estado");

    estados.forEach((sigla) => {
        const option = document.createElement("option");
        option.value = sigla;
        option.textContent = sigla;
        selectEstado.appendChild(option);
    });
    // Adicionar um option vazio (seleção inicial vazia)
    const optionVazio = document.createElement("option");
    optionVazio.value = "";
    optionVazio.textContent = "";
    selectEstado.insertBefore(optionVazio, selectEstado.firstChild);
}

// Chame as funções ao carregar a página
$(document).ready(function () {
    configurarComportamentoPerfil();
    validarAceiteTermos();
    adicionarEstados();
});

//Exibir senha login
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('show-password');

    showPasswordCheckbox.addEventListener('change', function () {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text'; // Mostrar a senha
        } else {
            passwordInput.type = 'password'; // Ocultar a senha
        }
    });
}

// Função para ativar exibir senha login
togglePasswordVisibility();

