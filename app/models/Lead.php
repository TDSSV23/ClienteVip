<?php
class LeadModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function criarLead($dados)
    {
        $this->db->query('INSERT INTO leads (nome, email, empresa, mensagem) VALUES (:nome, :email, :empresa, :mensagem)');
        $this->db->bind(':nome', $dados['nome']);
        $this->db->bind(':email', $dados['email']);
        $this->db->bind(':empresa', $dados['empresa']);
        $this->db->bind(':mensagem', $dados['mensagem']);
        return $this->db->execute();
    }

    public function obterLeads()
    {
        $this->db->query('SELECT * FROM leads');
        return $this->db->resultset();
    }
}
