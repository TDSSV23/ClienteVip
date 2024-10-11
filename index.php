<?php
require_once 'config/db.php';
require_once 'app/Models/Database.php';
require_once 'app/Models/Cliente.php';
require_once 'app/Controllers/ClienteController.php';

$clienteModel = new ClienteModel();
$clienteController = new ClienteController($clienteModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $cliente = $clienteController->buscarPorCPF($cpf);
    if ($cliente && $cliente['senha'] == $senha) {
        echo 'Bem-vindo, ' . $cliente['nome'];
    } else {
        echo 'Login ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Cliente VIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="jumbotron text-center bg-success text-white">
            <h1>Bem-vindo ao CRM Cliente VIP</h1>
            <p>Gerencie seus clientes de forma eficiente e personalizada.</p>
            <a href="login.php" class="btn btn-light">Acessar Conta</a>
            <a href="registro.php" class="btn btn-light">Cadastre-se</a>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md-4">
                <h2>Gestão de Clientes</h2>
                <p>Crie, edite e gerencie os dados de seus clientes facilmente.</p>
            </div>
            <div class="col-md-4">
                <h2>Campanhas Personalizadas</h2>
                <p>Crie campanhas de marketing e acompanhe os resultados em tempo real.</p>
            </div>
            <div class="col-md-4">
                <h2>Relatórios de Vendas</h2>
                <p>Visualize relatórios detalhados sobre suas vendas e clientes.</p>
            </div>
        </div>
    </div>
</body>

</html>