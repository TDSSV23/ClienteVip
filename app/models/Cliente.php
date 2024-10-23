<?php


class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function cadastrarCliente($dados)
    {
        $dados['cpf'] = preg_replace('/[^0-9]/', '', $dados['cpf']); // Remove caracteres não numéricos

        if (strlen($dados['cpf']) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        if (!$this->validarCPF($dados['cpf'])) {
            throw new Exception('CPF inválido.');
        }

        try {
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

            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            // Verifica se o erro é relacionado à duplicidade de CPF
            if ($e->getCode() == 23000) { // CPF já cadastrado
                echo '<div id="error-message" class="alert alert-danger text-center mt-4">Erro: CPF já cadastrado.</div>';
            } else {
                echo '<div id="error-message" class="alert alert-danger text-center mt-4">Erro ao cadastrar cliente: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            // Adiciona o script para ocultar a mensagem após 5 segundos
            echo '<script>setTimeout(function() { document.getElementById("error-message").style.display = "none"; }, 5000);</script>';
            return false;
        }
    }

    public function buscarClientePorCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        if (!$this->validarCPF($cpf)) {
            throw new Exception('CPF inválido.');
        }

        $this->db->query('SELECT * FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);

        try {
            $cliente = $this->db->single();
            if ($cliente) {
                return $cliente;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new Exception('Erro ao buscar cliente: ' . $e->getMessage());
        }
    }

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

    public function atualizarCliente($cpf, $dados)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) !== 11) {
            throw new Exception('CPF inválido. Deve conter exatamente 11 dígitos.');
        }

        if (!$this->validarCPF($cpf)) {
            throw new Exception('CPF inválido.');
        }

        $this->db->query('UPDATE cliente SET nome = :nome, telefone = :telefone, email = :email, 
                          endereco = :endereco, idade = :idade, genero = :genero WHERE cpf = :cpf');

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

    private function validarCPF($cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

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

    public function verificarSenhaAtual($cpf, $senhaAtual)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        $this->db->query('SELECT senha FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);

        try {
            $cliente = $this->db->single();
            if ($cliente && isset($cliente['senha'])) {
                return password_verify($senhaAtual, $cliente['senha']);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar senha atual: ' . $e->getMessage());
        }
    }
    // Função para cadastrar um novo cliente
}
