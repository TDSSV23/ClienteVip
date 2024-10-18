<?php

require_once 'Database.php'; // Certifique-se de que este caminho está correto.

class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Função para cadastrar um novo cliente
    public function cadastrarCliente($dados)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $dados['cpf'] = preg_replace('/[^0-9]/', '', $dados['cpf']);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($dados['cpf']) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        // Validação opcional de CPF (verifica os dígitos verificadores)
        if (!$this->validarCPF($dados['cpf'])) {
            throw new Exception('CPF inválido.');
        }

        // Monta a query para inserir o cliente no banco de dados
        $this->db->query('INSERT INTO cliente (nome, telefone, email, endereco, idade, cpf, genero, senha) 
                          VALUES (:nome, :telefone, :email, :endereco, :idade, :cpf, :genero, :senha)');

        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':telefone', $dados['telefone']);
        $this->db->bind(':email', $dados['email']);
        $this->db->bind(':endereco', $dados['endereco']);
        $this->db->bind(':idade', $dados['idade']);
        $this->db->bind(':cpf', $dados['cpf']);
        $this->db->bind(':genero', $dados['genero']);
        $this->db->bind(':senha', $dados['senha']);  // Senha já hasheada

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao cadastrar cliente: ' . $e->getMessage());
        }
    }

    // Função para buscar um cliente pelo CPF
    public function buscarClientePorCPF($cpf)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        // Validação opcional de CPF
        if (!$this->validarCPF($cpf)) {
            throw new Exception('CPF inválido.');
        }

        // Monta a query para buscar o cliente pelo CPF
        $this->db->query('SELECT * FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);

        try {
            return $this->db->single();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar cliente: ' . $e->getMessage());
        }
    }

    // Função para atualizar a senha do cliente
    public function atualizarSenha($cpf, $novaSenhaHash)
    {
        $this->db->query('UPDATE cliente SET senha = :senha WHERE cpf = :cpf');
        $this->db->bind(':senha', $novaSenhaHash);
        $this->db->bind(':cpf', $cpf);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar senha: ' . $e->getMessage());
        }
    }

    // Função para atualizar os dados do cliente
    public function atualizarCliente($cpf, $dados)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        // Validação de CPF
        if (!$this->validarCPF($cpf)) {
            throw new Exception('CPF inválido.');
        }

        // Monta a query de atualização
        $this->db->query('UPDATE cliente SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco, idade = :idade, genero = :genero WHERE cpf = :cpf');

        // Vincula os valores
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':telefone', $dados['telefone']);
        $this->db->bind(':email', $dados['email']);
        $this->db->bind(':endereco', $dados['endereco']);
        $this->db->bind(':idade', $dados['idade']);
        $this->db->bind(':genero', $dados['genero']);
        $this->db->bind(':cpf', $cpf);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar cliente: ' . $e->getMessage());
        }
    }

    // Função para validar o CPF (opcional)
    private function validarCPF($cpf)
    {
        // Verifica se todos os dígitos são iguais, o que invalida o CPF
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Cálculo para verificar os dígitos verificadores do CPF
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    // Função para verificar se a senha atual corresponde ao hash armazenado
    public function verificarSenhaAtual($cpf, $senhaAtual)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Monta a query para buscar a senha atual (hash) pelo CPF
        $this->db->query('SELECT senha FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);

        try {
            $cliente = $this->db->single();
            if ($cliente && isset($cliente['senha'])) {
                // Verifica se a senha fornecida corresponde ao hash armazenado
                return password_verify($senhaAtual, $cliente['senha']);
            } else {
                return false;  // Cliente não encontrado ou senha não disponível
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar senha atual: ' . $e->getMessage());
        }
    }
}
