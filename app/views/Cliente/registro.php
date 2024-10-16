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
    if ($clienteController->cadastrar($dados)) {
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include '../layout/header_publico.php'; ?>
    <title>Cadastro de Cliente</title>
</head>

<body>
    <div class="container mt-5">
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
    <?php include '../Layout/footer.php'; ?>
</body>

</html>