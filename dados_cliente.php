<?php
session_start();

if (!isset($_SESSION['cliente'])) {
    header('Location: login.php');
    exit();
}

$cliente = $_SESSION['cliente'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Dados do Cliente</h1>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($cliente['nome']); ?></p>
        <p><strong>CPF:</strong> <?php echo htmlspecialchars($cliente['cpf']); ?></p>
        <p><strong>Endereço:</strong> <?php echo htmlspecialchars($cliente['endereco']); ?></p>
        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($cliente['telefone']); ?></p>
        <p><strong>Idade:</strong> <?php echo htmlspecialchars($cliente['idade']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
        <p><strong>Gênero:</strong> <?php echo htmlspecialchars($cliente['genero']); ?></p>
    </div>
</body>

</html>