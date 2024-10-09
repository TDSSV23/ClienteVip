<?php

class Negocio
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar novo negócio
    public function criar($data_negocio, $valor_transacao, $notas, $id_cliente)
    {
        $sql = "INSERT INTO NEGOCIO (data_negocio, valor_transacao, notas, id_cliente) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data_negocio, $valor_transacao, $notas, $id_cliente]);
    }

    // Listar negócios
    public function listar()
    {
        $sql = "SELECT * FROM NEGOCIO";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar negócio
    public function atualizar($id_negocio, $data_negocio, $valor_transacao, $notas)
    {
        $sql = "UPDATE NEGOCIO 
                SET data_negocio=?, valor_transacao=?, notas=? 
                WHERE id_negocio=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data_negocio, $valor_transacao, $notas, $id_negocio]);
    }

    // Deletar negócio
    public function deletar($id_negocio)
    {
        $sql = "DELETE FROM NEGOCIO WHERE id_negocio=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_negocio]);
    }
}
