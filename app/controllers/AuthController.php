<?php

class AuthController
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function register($data)
    {
        $nome = $this->mysqli->real_escape_string($data['nome']);
        $email = $this->mysqli->real_escape_string($data['email']);
        $telefone = $this->mysqli->real_escape_string($data['telefone']);
        $senha = password_hash($data['senha'], PASSWORD_BCRYPT);

        // Verifica se o email já existe
        $result = $this->mysqli->query("SELECT * FROM CLIENTE WHERE email = '$email'");
        if ($result->num_rows > 0) {
            echo "Email já cadastrado!";
            return;
        }

        // Insere o novo cliente no banco
        $sql = "INSERT INTO CLIENTE (nome, email, telefone, senha) VALUES ('$nome', '$email', '$telefone', '$senha')";
        if ($this->mysqli->query($sql)) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $this->mysqli->error;
        }
    }

    public function login($data)
    {
        $email = $this->mysqli->real_escape_string($data['email']);
        $senha = $data['senha'];

        // Verifica o email
        $result = $this->mysqli->query("SELECT * FROM CLIENTE WHERE email = '$email'");
        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();

            // Verifica a senha
            if (password_verify($senha, $cliente['senha'])) {
                // Define a sessão
                $_SESSION['id_cliente'] = $cliente['id_cliente'];
                echo "Login bem-sucedido!";
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Email não encontrado!";
        }
    }

    public function logout()
    {
        session_destroy();
        echo "Logout realizado com sucesso!";
    }
}
