<?php

class Campanha
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar nova campanha
    public function criar($nome, $inicio, $termino, $status, $orcamento, $tipo, $id_interesse)
    {
        $sql = "INSERT INTO CAMPANHA (nome, inicio, termino, status, orcamento, tipo, id_interesse) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $inicio, $termino, $status, $orcamento, $tipo, $id_interesse]);
    }

    // Listar campanhas
    public function listar()
    {
        $sql = "SELECT * FROM CAMPANHA";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar campanha
    public function atualizar($id_campanha, $nome, $inicio, $termino, $status, $orcamento, $tipo, $id_interesse)
    {
        $sql = "UPDATE CAMPANHA 
                SET nome=?, inicio=?, termino=?, status=?, orcamento=?, tipo=?, id_interesse=? 
                WHERE id_campanha=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $inicio, $termino, $status, $orcamento, $tipo, $id_interesse, $id_campanha]);
    }

    // Deletar campanha
    public function deletar($id_campanha)
    {
        $sql = "DELETE FROM CAMPANHA WHERE id_campanha=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_campanha]);
    }
}
