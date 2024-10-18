// Função para alternar a visibilidade da senha
function togglePassword() {
    const passwordField = document.getElementById('password');
    const passwordBtn = document.querySelector('.btn-outline-primary');

    if (passwordField.textContent === '******') {
        passwordField.textContent = passwordField.getAttribute('data-password');  // Exibe a senha oculta
        passwordBtn.textContent = 'Ocultar senha';
    } else {
        passwordField.textContent = '******';  // Oculta a senha novamente
        passwordBtn.textContent = 'Mostrar senha';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var editarBtn = document.getElementById('editarInformacoesBtn');
    var formEdicao = document.getElementById('formEdicao');
    var mensagemDiv = document.getElementById('mensagem');
    var editarClienteForm = document.getElementById('editarClienteForm');
    var btnInformacoes = document.getElementById('btnInformacoes');
    var btnSenha = document.getElementById('btnSenha');
    var secaoInformacoes = document.getElementById('secaoInformacoes');
    var secaoSenha = document.getElementById('secaoSenha');
    var alterarSenhaForm = document.getElementById('alterarSenhaForm');
    var mensagemSenhaDiv = document.getElementById('mensagemSenha');
    var toggleNovaSenhaBtn = document.getElementById('toggleNovaSenha');
    var novaSenhaField = document.getElementById('novaSenha');

    // Exibir/ocultar seções ao clicar nos botões
    btnInformacoes.addEventListener('click', function () {
        secaoInformacoes.style.display = 'block';
        secaoSenha.style.display = 'none';
        btnInformacoes.classList.add('active');
        btnSenha.classList.remove('active');
    });

    btnSenha.addEventListener('click', function () {
        secaoSenha.style.display = 'block';
        secaoInformacoes.style.display = 'none';
        btnSenha.classList.add('active');
        btnInformacoes.classList.remove('active');
    });

    // Exibir/ocultar o formulário de edição de informações
    editarBtn.addEventListener('click', function () {
        formEdicao.style.display = formEdicao.style.display === 'none' ? 'block' : 'none';
    });

    // Função para alternar visibilidade da nova senha
    toggleNovaSenhaBtn.addEventListener('click', function () {
        if (novaSenhaField.type === 'password') {
            novaSenhaField.type = 'text'; // Exibe a senha
            toggleNovaSenhaBtn.textContent = 'Ocultar senha';
        } else {
            novaSenhaField.type = 'password'; // Oculta a senha
            toggleNovaSenhaBtn.textContent = 'Mostrar senha';
        }
    });

    // Enviar o formulário de alteração de informações pessoais via AJAX
    editarClienteForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(editarClienteForm);

        fetch('', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                mensagemDiv.style.display = 'block';
                if (data.success) {
                    mensagemDiv.className = 'alert alert-success';
                    mensagemDiv.textContent = data.message;
                    formEdicao.style.display = 'none';
                } else {
                    mensagemDiv.className = 'alert alert-danger';
                    mensagemDiv.textContent = data.message;
                }
            })
            .catch(error => {
                mensagemDiv.style.display = 'block';
                mensagemDiv.className = 'alert alert-danger';
                mensagemDiv.textContent = 'Erro na requisição: ' + error;
            });
    });

    // Enviar o formulário de alteração de senha via AJAX
    alterarSenhaForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(alterarSenhaForm);

        fetch('', { // Requisição para a própria página
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                mensagemSenhaDiv.style.display = 'block';
                if (data.success) {
                    mensagemSenhaDiv.className = 'alert alert-success';
                    mensagemSenhaDiv.textContent = data.message;
                    alterarSenhaForm.reset(); // Limpar o formulário após sucesso
                } else {
                    mensagemSenhaDiv.className = 'alert alert-danger';
                    mensagemSenhaDiv.textContent = data.message;
                }
            })
            .catch(error => {
                mensagemSenhaDiv.style.display = 'block';
                mensagemSenhaDiv.className = 'alert alert-danger';
                mensagemSenhaDiv.textContent = 'Erro na requisição: ' + error;
            });
    });
});

