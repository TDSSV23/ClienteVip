<?php
class NegocioModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function criarNegocio($dados)
    {
        $this->db->query('INSERT INTO negocio (titulo, descricao, status, data_negocio, valor_transacao, notas) VALUES (:titulo, :descricao, :status, :data_negocio, :valor_transacao, :notas)');
        $this->db->bind(':titulo', $dados['titulo']);
        $this->db->bind(':descricao', $dados['descricao']);
        $this->db->bind(':status', $dados['status']);
        $this->db->bind(':data_negocio', $dados['data_negocio']);
        $this->db->bind(':valor_transacao', $dados['valor_transacao']);
        $this->db->bind(':notas', $dados['notas']);
        return $this->db->execute();
    }

    public function obterNegocios()
    {
        $this->db->query('SELECT * FROM negocio');
        return $this->db->resultset();
    }

    public function atualizarStatus($id, $status)
    {
        $this->db->query('UPDATE negocio SET status = :status WHERE id_negocio = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
