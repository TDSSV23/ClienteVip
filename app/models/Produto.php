<?php

class Produto
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar novo produto
    public function criar($nome, $valor_unitario)
    {
        $sql = "INSERT INTO PRODUTO (nome, valor_unitario) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $valor_unitario]);
    }

    // Listar produtos
    public function listar()
    {
        $sql = "SELECT * FROM PRODUTO";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar produto
    public function atualizar($id_produto, $nome, $valor_unitario)
    {
        $sql = "UPDATE PRODUTO 
                SET nome=?, valor_unitario=? 
                WHERE id_produto=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $valor_unitario, $id_produto]);
    }

    // Deletar produto
    public function deletar($id_produto)
    {
        $sql = "DELETE FROM PRODUTO WHERE id_produto=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_produto]);
    }
}
