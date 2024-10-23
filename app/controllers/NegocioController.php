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
        // Monta a query para inserir o lead no banco de dados
        $this->db->query('INSERT INTO lead (nome, status, empresa, cargo, telefone, criado_em) 
                          VALUES (:nome, :status, :empresa, :cargo, :telefone, :criado_em)');

        // Bind dos parâmetros
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':status', $dados['status']);
        $this->db->bind(':empresa', $dados['empresa']);
        $this->db->bind(':cargo', $dados['cargo']);
        $this->db->bind(':telefone', $dados['telefone']);
        $this->db->bind(':criado_em', date('Y-m-d H:i:s'));

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            throw new Exception('Erro ao cadastrar lead: ' . $e->getMessage());
        }
    }

    // Função para buscar um lead pelo ID
    public function buscarLeadPorID($id)
    {
        $this->db->query('SELECT * FROM lead WHERE id = :id');
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
        $this->db->query('UPDATE lead SET nome = :nome, status = :status, empresa = :empresa, cargo = :cargo, telefone = :telefone 
                          WHERE id = :id');

        // Bind dos parâmetros
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':status', $dados['status']);
        $this->db->bind(':empresa', $dados['empresa']);
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
        $this->db->query('SELECT * FROM lead');

        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            throw new Exception('Erro ao listar leads: ' . $e->getMessage());
        }
    }
}
