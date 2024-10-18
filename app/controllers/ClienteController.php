<?php
require_once('../models/Cliente.php');

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
            if ($this->model->buscarClientePorCPF($dados['cpf'])) {
                return ['success' => false, 'message' => 'CPF já cadastrado.'];
            }

            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

            if ($this->model->cadastrarCliente($dados)) {
                return ['success' => true, 'message' => 'Cliente cadastrado com sucesso.'];
            } else {
                return ['success' => false, 'message' => 'Erro ao cadastrar cliente.'];
            }
        } catch (Exception $e) {
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
            // Validar entradas
            if (empty($cpf) || empty($senhaAtual) || empty($novaSenha)) {
                return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
            }

            // Chama o método verificarSenhaAtual do modelo
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
            return ['success' => false, 'message' => $e->getMessage()];
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
