<?php

class Cliente
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Cadastro de cliente
    public function cadastrar($nome, $email, $senha, $telefone, $endereco, $idade, $cpf, $genero)
    {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO CLIENTE (nome, email, senha, telefone, endereco, idade, cpf, genero) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $email, $senhaHash, $telefone, $endereco, $idade, $cpf, $genero]);
    }

    // Login do cliente
    public function login($email, $senha)
    {
        $sql = "SELECT * FROM CLIENTE WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $cliente = $stmt->fetch();
        if ($cliente && password_verify($senha, $cliente['senha'])) {
            return $cliente;
        }
        return false;
    }

    // Ler todos os clientes
    public function listar()
    {
        $sql = "SELECT * FROM CLIENTE";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Atualizar cliente
    public function atualizar($id_cliente, $nome, $telefone, $email, $endereco, $idade, $cpf, $genero)
    {
        $sql = "UPDATE CLIENTE 
                SET nome=?, telefone=?, email=?, endereco=?, idade=?, cpf=?, genero=? 
                WHERE id_cliente=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $telefone, $email, $endereco, $idade, $cpf, $genero, $id_cliente]);
    }

    // Deletar cliente
    public function deletar($id_cliente)
    {
        $sql = "DELETE FROM CLIENTE WHERE id_cliente=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_cliente]);
    }
}
