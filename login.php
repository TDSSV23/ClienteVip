<?php
require_once '../config.php';
require_once '../app/Models/Database.php';
require_once '../app/Models/ClienteModel.php';
require_once '../app/Controllers/ClienteController.php';

session_start();

$clienteModel = new ClienteModel();
$clienteController = new ClienteController($clienteModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $cliente = $clienteController->buscarPorCPF($cpf);
    if ($cliente && $cliente['senha'] == $senha) {
        $_SESSION['cliente'] = $cliente;
        header('Location: dados_cliente.php');
        exit();
    } else {
        echo '<div class="alert alert-danger">Login ou senha incorretos.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Login</h1>
        <form method="post" action="">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="cpf" placeholder="CPF" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</body>
</html>
