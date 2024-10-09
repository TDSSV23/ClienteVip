<?php

class Interesse
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar novo interesse
    public function criar($nome, $descricao)
    {
        $sql = "INSERT INTO INTERESSE (nome, descricao) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $descricao]);
    }

    // Listar interesses
    public function listar()
    {
        $sql = "SELECT * FROM INTERESSE";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar interesse
    public function atualizar($id_interesse, $nome, $descricao)
    {
        $sql = "UPDATE INTERESSE 
                SET nome=?, descricao=? 
                WHERE id_interesse=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $descricao, $id_interesse]);
    }

    // Deletar interesse
    public function deletar($id_interesse)
    {
        $sql = "DELETE FROM INTERESSE WHERE id_interesse=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_interesse]);
    }
}
