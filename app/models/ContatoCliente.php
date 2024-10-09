<?php

class ContatoCliente
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar novo contato
    public function criar($data_contato, $id_cliente, $assunto, $id_interesse, $id_campanha)
    {
        $sql = "INSERT INTO CONTATO_CLIENTE (data_contato, id_cliente, assunto, id_interesse, id_campanha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data_contato, $id_cliente, $assunto, $id_interesse, $id_campanha]);
    }

    // Listar contatos
    public function listar()
    {
        $sql = "SELECT * FROM CONTATO_CLIENTE";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar contato
    public function atualizar($id_relacao, $data_contato, $id_cliente, $assunto, $id_interesse, $id_campanha)
    {
        $sql = "UPDATE CONTATO_CLIENTE 
                SET data_contato=?, id_cliente=?, assunto=?, id_interesse=?, id_campanha=? 
                WHERE id_relacao=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data_contato, $id_cliente, $assunto, $id_interesse, $id_campanha, $id_relacao]);
    }

    // Deletar contato
    public function deletar($id_relacao)
    {
        $sql = "DELETE FROM CONTATO_CLIENTE WHERE id_relacao=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_relacao]);
    }
}
