// Função para alternar a visibilidade de uma senha
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const btnInformacoes = document.getElementById('btnInformacoes');
    const btnSenha = document.getElementById('btnSenha');
    const secaoInformacoes = document.getElementById('secaoInformacoes');
    const secaoSenha = document.getElementById('secaoSenha');
    const editarClienteForm = document.getElementById('editarClienteForm');
    const alterarSenhaForm = document.getElementById('alterarSenhaForm');
    const mensagemSenha = document.getElementById('mensagemSenha');

    // Elementos para exibir/ocultar formulário de alteração de senha
    const btnAlterarSenha = document.getElementById('btnAlterarSenha');
    const formAlterarSenha = document.getElementById('formAlterarSenha');

    // Alternar para "Informações Pessoais"
    btnInformacoes.addEventListener('click', function () {
        secaoInformacoes.style.display = 'block';
        secaoSenha.style.display = 'none';
        formAlterarSenha.style.display = 'none';  // Oculta o formulário de alteração de senha ao mudar de seção
    });

    // Alternar para "Alterar Senha"
    btnSenha.addEventListener('click', function () {
        secaoInformacoes.style.display = 'none';
        secaoSenha.style.display = 'block';
    });

    // Exibir/ocultar o formulário de alteração de senha ao clicar no botão
    btnAlterarSenha.addEventListener('click', function () {
        formAlterarSenha.style.display = formAlterarSenha.style.display === 'none' ? 'block' : 'none';
    });

    // Alternar visibilidade da senha atual
    document.getElementById('toggleSenhaAtual').addEventListener('click', function () {
        togglePassword('senhaAtual', 'toggleSenhaAtual');
    });

    // Alternar visibilidade da nova senha
    document.getElementById('toggleNovaSenha').addEventListener('click', function () {
        togglePassword('novaSenha', 'toggleNovaSenha');
    });

    // Envio do formulário de edição de informações via AJAX
    editarClienteForm.addEventListener('submit', function (e) {
        e.preventDefault();  // Evita o reload da página
        const formData = new FormData(editarClienteForm);

        fetch('', {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
            .then(response => response.json())
            .then(data => {
                mostrarMensagem(data.message, data.success ? 'success' : 'danger');
                if (data.success) window.location.reload();  // Recarrega a página após sucesso
            })
            .catch(error => mostrarMensagem('Erro ao atualizar informações.', 'danger'));
    });

    // Envio do formulário de alteração de senha via AJAX
    alterarSenhaForm.addEventListener('submit', function (e) {
        e.preventDefault();  // Evita o reload da página
        const formData = new FormData(alterarSenhaForm);

        fetch('', {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
            .then(response => response.json())
            .then(data => {
                mostrarMensagem(data.message, data.success ? 'success' : 'danger');
                if (data.success) alterarSenhaForm.reset();  // Limpa o formulário após sucesso
            })
            .catch(error => mostrarMensagem('Erro ao alterar senha.', 'danger'));
    });

    // Função para exibir mensagens de feedback
    function mostrarMensagem(mensagem, tipo) {
        mensagemSenha.textContent = mensagem;
        mensagemSenha.className = `alert alert-${tipo}`;
        mensagemSenha.style.display = 'block';

        // Ocultar mensagem após 3 segundos
        setTimeout(() => {
            mensagemSenha.style.display = 'none';
        }, 3000);
    }
});
