<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit();
}

require_once '../models/Cliente.php';
require_once '../controllers/ClienteController.php';

// Instanciando o modelo e o controlador
$model = new ClienteModel();
$controller = new ClienteController($model);

// Buscar dados do cliente pelo CPF armazenado na sessão
$cpf = $_SESSION['cpf'];
$cliente = $controller->buscarPorCPF($cpf);

if (!$cliente) {
    echo '<div class="alert alert-danger text-center mt-4">Erro: Cliente não encontrado.</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include '../layout/header_logado.php'; ?>
    <title>Perfil do Cliente</title>
    <link href="../../../public/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include '../layout/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../layout/topbar.php'; ?>

                <div class="container mt-5">
                    <h1 class="h3 mb-4 text-gray-800">Perfil do Cliente</h1>

                    <form>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="idade" class="form-label">Idade</label>
                            <input type="number" class="form-control" id="idade" value="<?php echo $cliente['idade']; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" value="<?php echo $cliente['cpf']; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="genero" class="form-label">Gênero</label>
                            <input type="text" class="form-control" id="genero" value="<?php echo htmlspecialchars($cliente['genero']); ?>" readonly>
                        </div>
                    </form>
                </div>
            </div>

            <?php include '../layout/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>