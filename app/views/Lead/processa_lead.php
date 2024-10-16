<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/Lead.php';
require_once '../../Controllers/LeadController.php';

$leadModel = new LeadModel();
$leadController = new LeadController($leadModel);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'empresa' => $_POST['empresa'],
        'mensagem' => $_POST['mensagem']
    ];

    if ($leadController->criarLead($dados)) {
        echo '<div class="alert alert-success">Lead cadastrado com sucesso!</div>';
    } else {
        echo '<div class="alert alert-danger">Erro ao cadastrar lead.</div>';
    }
}
