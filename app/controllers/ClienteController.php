<?php

class ClienteController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function cadastrar($dados)
    {
        try {
            // Criptografa a senha
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

            // Tenta cadastrar o cliente
            if ($this->model->cadastrarCliente($dados)) {
                // Exibe a mensagem de sucesso e oculta após 5 segundos
                echo '<div id="success-message" class="alert alert-success text-center mt-4">Cliente cadastrado com sucesso.</div>';
                echo '<script>setTimeout(function() { document.getElementById("success-message").style.display = "none"; }, 5000);</script>';
                return ['success' => true, 'message' => 'Cliente cadastrado com sucesso.'];
            } else {
                // Exibe a mensagem de erro e oculta após 5 segundos
                return ['success' => false, 'message' => 'echo'<'div id="error-message" class="alert alert-danger text-center mt-4">Erro ao cadastrar cliente.</div>'];
                echo '<script>setTimeout(function() { document.getElementById("error-message").style.display = "none"; }, 5000);</script>';
            }
        } catch (Exception $e) {
            // Exibe a mensagem de erro e oculta após 5 segundos
            echo '<div id="error-message" class="alert alert-danger text-center mt-4">Erro ao cadastrar cliente: ' . htmlspecialchars($e->getMessage()) . '</>';
            echo '<script>setTimeout(function() { document.getElementById("error-message").style.display = "none"; }, 5000);</script>';
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    public function buscarPorCPF($cpf)
    {
        try {
            $cliente = $this->model->buscarClientePorCPF($cpf);
            if ($cliente) {
                return $cliente;
            } else {
                return ['success' => false, 'message' => 'Cliente não encontrado.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function redefinirSenha($cpf, $senhaAtual, $novaSenha)
    {
        try {
            // Verifica se o CPF e as senhas foram fornecidos
            if (empty($cpf) || empty($senhaAtual) || empty($novaSenha)) {
                return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
            }

            // Verifica se a senha atual está correta
            if ($this->model->verificarSenhaAtual($cpf, $senhaAtual)) {
                // Gera o hash da nova senha
                $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

                // Atualiza a senha no banco de dados
                if ($this->model->atualizarSenha($cpf, $novaSenhaHash)) {
                    return ['success' => true, 'message' => 'Senha atualizada com sucesso.'];
                } else {
                    return ['success' => false, 'message' => 'Erro ao atualizar senha.'];
                }
            } else {
                // Senha atual incorreta
                return ['success' => false, 'message' => 'Senha atual incorreta.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Erro ao redefinir senha: ' . $e->getMessage()];
        }
    }


    public function atualizarCliente($cpf, $dados)
    {
        try {
            if (!$this->model->buscarClientePorCPF($cpf)) {
                return ['success' => false, 'message' => 'Cliente não encontrado.'];
            }

            if ($this->model->atualizarCliente($cpf, $dados)) {
                return ['success' => true, 'message' => 'Dados atualizados com sucesso.'];
            } else {
                return ['success' => false, 'message' => 'Erro ao atualizar cliente.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
