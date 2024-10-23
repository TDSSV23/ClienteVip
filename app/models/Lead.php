<?php

class LeadModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Função para cadastrar um novo lead
    public function cadastrarLead($dados)
    {
        // Insere os campos corretos da tabela leads
        $this->db->query('INSERT INTO leads (nome, email, empresa, mensagem, cargo, telefone, data_criacao) 
                          VALUES (:nome, :email, :empresa, :mensagem, :cargo, :telefone, :data_criacao)');

        // Bind dos parâmetros
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':email', $dados['email']);
        $this->db->bind(':empresa', $dados['empresa']);
        $this->db->bind(':mensagem', $dados['mensagem']);
        $this->db->bind(':cargo', $dados['cargo']);
        $this->db->bind(':telefone', $dados['telefone']);
        $this->db->bind(':data_criacao', date('Y-m-d H:i:s'));  // Define a data atual para o campo data_criacao

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao cadastrar lead: ' . $e->getMessage());
        }
    }

    // Função para buscar um lead pelo ID
    public function buscarLeadPorID($id)
    {
        $this->db->query('SELECT * FROM leads WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar lead: ' . $e->getMessage());
        }
    }

    // Função para atualizar um lead
    public function atualizarLead($id, $dados)
    {
        $this->db->query('UPDATE leads SET nome = :nome, email = :email, empresa = :empresa, mensagem = :mensagem, cargo = :cargo, telefone = :telefone 
                          WHERE id = :id');

        // Bind dos parâmetros
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':email', $dados['email']);
        $this->db->bind(':empresa', $dados['empresa']);
        $this->db->bind(':mensagem', $dados['mensagem']);
        $this->db->bind(':cargo', $dados['cargo']);
        $this->db->bind(':telefone', $dados['telefone']);
        $this->db->bind(':id', $id);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar lead: ' . $e->getMessage());
        }
    }

    // Função para listar todos os leads
    public function listarLeads()
    {
        $this->db->query('SELECT * FROM leads');

        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar leads: ' . $e->getMessage());
        }
    }
}
