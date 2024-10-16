<?php

session_start(); // Inicia a sessão

// Verificar se existe o cliente na sessão
if (!isset($_SESSION['cliente'])) {
    echo 'Cliente não encontrado na sessão. Redirecionando para login...';
    header('Location: login.php');
    exit();
}

// Recupera o CPF da sessão
$cliente = $_SESSION['cliente'];
$cpf = $cliente['cpf'];

require_once '../../models/Cliente.php';
require_once '../../controllers/ClienteController.php';

$model = new ClienteModel();
$controller = new ClienteController($model);

// Buscar o cliente no banco de dados com o CPF
$cliente = $controller->buscarPorCPF($cpf);

if (!$cliente) {
    echo 'Cliente não encontrado. Redirecionando para login...';
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perfil do Cliente</title>
</head>

<body>
    <h1>Perfil do Cliente</h1>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($cliente['nome']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
    <p><strong>CPF:</strong> <?php echo htmlspecialchars($cliente['cpf']); ?></p>
    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($cliente['telefone']); ?></p>
    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($cliente['endereco']); ?></p>
    <p><strong>Idade:</strong> <?php echo htmlspecialchars($cliente['idade']); ?></p>
    <p><strong>Gênero:</strong> <?php echo htmlspecialchars($cliente['genero']); ?></p>
    <p><strong>Senha:</strong> <?php echo htmlspecialchars($cliente['senha']); ?></p>
    <!-- Outros dados do cliente... -->
</body>

</html>