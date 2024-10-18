<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/Cliente.php';
require_once '../../Controllers/ClienteController.php';

session_start(); // Início da sessão

// Instanciar o modelo e o controlador
$model = new ClienteModel();
$controller = new ClienteController($model);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Limpar CPF
    $senha = $_POST['senha'];

    // Buscar cliente pelo CPF
    $cliente = $controller->buscarPorCPF($cpf);

    // Verificar se o cliente existe e se a senha está correta
    if ($cliente && password_verify($senha, $cliente['senha'])) {
        // Armazenar os dados do cliente na sessão e CPF em cookie seguro
        $_SESSION['cliente'] = $cliente;
        setcookie('cpf', $cliente['cpf'], time() + 3600, "/", "", true, true); // Secure e HttpOnly

        // Redirecionar para a página principal
        header('Location: ../../../principal.php');
        exit();
    } else {
        // Exibir mensagem de erro se as credenciais forem inválidas
        echo '<div class="alert alert-danger text-center">Login ou senha incorretos.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../layout/header_publico.php'; ?>
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" placeholder="CPF" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="mt-4">
            <h4>Esqueceu sua senha?</h4>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="cpf_redefinir" class="form-label">Digite seu CPF para redefinir a senha</label>
                    <input type="text" class="form-control" name="cpf_redefinir" placeholder="CPF" required>
                </div>
                <button type="submit" class="btn btn-warning">Redefinir Senha</button>
            </form>
        </div>
    </div>

    <?php include '../layout/footer.php'; ?>
</body>

</html>
