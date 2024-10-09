<?php

class ClienteController
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function mostrarCrud()
    {
        echo "<h2>CRUD Clientes</h2>";
        echo "<a href='?action=logout'>Logout</a><br><br>";

        // Formulário para criar um novo cliente
        echo "<h3>Adicionar Cliente</h3>";
        echo '<form method="POST" action="?action=createCliente">
                Nome: <input type="text" name="nome" required><br>
                Telefone: <input type="text" name="telefone" required><br>
                <input type="submit" value="Adicionar Cliente">
              </form>';

        // Exibir lista de clientes
        echo "<h3>Clientes Cadastrados</h3>";
        $result = $this->mysqli->query("SELECT * FROM CLIENTE");
        while ($cliente = $result->fetch_assoc()) {
            echo $cliente['nome'] . " - " . $cliente['telefone'];
            echo " <a href='?action=deleteCliente&id=" . $cliente['id_cliente'] . "'>Deletar</a><br>";
        }
    }

    public function create($data)
    {
        $nome = $this->mysqli->real_escape_string($data['nome']);
        $telefone = $this->mysqli->real_escape_string($data['telefone']);

        $sql = "INSERT INTO CLIENTE (nome, telefone) VALUES ('$nome', '$telefone')";
        if ($this->mysqli->query($sql)) {
            echo "Cliente adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar cliente: " . $this->mysqli->error;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM CLIENTE WHERE id_cliente = " . intval($id);
        if ($this->mysqli->query($sql)) {
            echo "Cliente deletado com sucesso!";
        } else {
            echo "Erro ao deletar cliente: " . $this->mysqli->error;
        }
    }
}
