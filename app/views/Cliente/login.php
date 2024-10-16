<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/Cliente.php';
require_once '../../Controllers/ClienteController.php';

session_start();

$clienteModel = new ClienteModel();
$clienteController = new ClienteController($clienteModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $senha = $_POST['senha'];

    $cliente = $clienteController->buscarPorCPF($cpf);

    if ($cliente && $cliente['senha'] == $senha) {
        $_SESSION['cliente'] = $cliente;
        header('Location: ../../principal.php');
        exit();
    } else {
        echo '<div class="alert alert-danger">Login ou senha incorretos.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include '../layout/header_publico.php'; ?>
    <title>Login</title>
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
    <?php include '../layout/footer.php'; ?>
</body>

</html>