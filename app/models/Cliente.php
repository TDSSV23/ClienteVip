<?php

require_once 'Database.php'; // Certifique-se de que este caminho está correto.

class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function cadastrarCliente($dados)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $dados['cpf'] = preg_replace('/[^0-9]/', '', $dados['cpf']);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($dados['cpf']) !== 11) {
            echo 'CPF inválido. Deve conter exatamente 11 dígitos.';
            return false;
        }

        // Validação opcional de CPF (verifica os dígitos verificadores)
        if (!$this->validarCPF($dados['cpf'])) {
            echo 'CPF inválido.';
            return false;
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
        $this->db->bind(':senha', $dados['senha']);

        try {
            $result = $this->db->execute();
            if ($result) {
                return true;
            } else {
                echo 'Erro ao executar a query.';
                return false;
            }
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    public function buscarClientePorCPF($cpf)
    {
        // Remove a formatação do CPF (deixa apenas números)
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            echo 'CPF inválido. Deve conter exatamente 11 dígitos.';
            return false;
        }

        // Validação opcional de CPF
        if (!$this->validarCPF($cpf)) {
            echo 'CPF inválido.';
            return false;
        }

        // Monta a query para buscar o cliente pelo CPF
        $this->db->query('SELECT * FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);
        return $this->db->single();
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

    // Outros métodos...
}
