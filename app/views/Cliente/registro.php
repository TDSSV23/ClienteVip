<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/Cliente.php';
require_once '../../Controllers/ClienteController.php';

$clienteModel = new ClienteModel();
$clienteController = new ClienteController($clienteModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'cpf' => $_POST['cpf'],
        'endereco' => $_POST['endereco'],
        'telefone' => $_POST['telefone'],
        'idade' => $_POST['idade'],
        'email' => $_POST['email'],
        'genero' => $_POST['genero'],
        'senha' => $_POST['senha']
    ];

    $resultado = $clienteController->cadastrar($dados);

    if ($resultado['success']) {
        header('Location: login.php');
        exit();
    } else {
        echo '<p>' . $resultado['message'] . '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include '../layout/header_publico.php'; ?>
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="../../../public/css/Cadastro.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <h1>Cadastro de Cliente</h1>
            <form method="post" action="">
                <div class="form-group row mb-3">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cpf" placeholder="CPF" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="endereco" placeholder="Endereço" required>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="telefone" placeholder="Telefone" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="idade" placeholder="Idade" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="genero" placeholder="Gênero" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </form>
        </div>
    </div>
    <?php include '../layout/footer.php'; ?>
</body>

</html>