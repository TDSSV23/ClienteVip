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
        // Verifica se o CPF já está cadastrado
        if ($this->model->buscarClientePorCPF($dados['cpf'])) {
            echo '<div class="alert alert-danger">Erro: CPF já cadastrado.</div>';
            return false;
        }

        // Cadastra o cliente
        if ($this->model->cadastrarCliente($dados)) {
            return true;
        } else {
            echo '<div class="alert alert-danger">Erro ao cadastrar cliente.</div>';
            return false;
        }
    }

    public function buscarPorCPF($cpf)
    {
        $cliente = $this->model->buscarClientePorCPF($cpf);
        if ($cliente) {
            return $cliente;
        } else {
            echo '<div class="alert alert-danger">Cliente não encontrado.</div>';
            return null;
        }
    }

    public function atualizarCliente($dados)
    {
        // Verifica se o cliente existe
        if ($this->model->buscarClientePorCPF($dados['cpf'])) {
            if ($this->model->atualizarCliente($dados)) {
                return true;
            } else {
                echo '<div class="alert alert-danger">Erro ao atualizar cliente.</div>';
                return false;
            }
        } else {
            echo '<div class="alert alert-danger">Erro: Cliente não encontrado.</div>';
            return false;
        }
    }

    public function excluirCliente($cpf)
    {
        // Verifica se o cliente existe
        if ($this->model->buscarClientePorCPF($cpf)) {
            if ($this->model->excluirCliente($cpf)) {
                return true;
            } else {
                echo '<div class="alert alert-danger">Erro ao excluir cliente.</div>';
                return false;
            }
        } else {
            echo '<div class="alert alert-danger">Erro: Cliente não encontrado.</div>';
            return false;
        }
    }
}
