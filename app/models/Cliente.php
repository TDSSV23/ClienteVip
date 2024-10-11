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
        $this->db->query('INSERT INTO cliente (nome, telefone, email, endereco, idade, cpf, genero, senha) VALUES (:nome, :telefone, :email, :endereco, :idade, :cpf, :genero, :senha)');
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
        $this->db->query('SELECT * FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);
        return $this->db->single();
    }

    public function atualizarCliente($dados)
    {
        $this->db->query('UPDATE cliente SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco, idade = :idade, genero = :genero, senha = :senha WHERE cpf = :cpf');
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

    public function excluirCliente($cpf)
    {
        $this->db->query('DELETE FROM cliente WHERE cpf = :cpf');
        $this->db->bind(':cpf', $cpf);

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
}
