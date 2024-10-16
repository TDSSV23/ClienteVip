<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/Lead.php';
require_once '../../Controllers/LeadController.php';


$leadModel = new LeadModel();
$leadController = new LeadController($leadModel);

$leads = $leadController->obterLeads();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include '../layout/header.php'; ?>
    <title>Leads Capturados</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Leads Capturados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Mensagem</th>
                    <th>Data de Captura</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($leads as $lead) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($lead['id_lead']) . '</td>';
                    echo '<td>' . htmlspecialchars($lead['nome']) . '</td>';
                    echo '<td>' . htmlspecialchars($lead['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($lead['empresa']) . '</td>';
                    echo '<td>' . htmlspecialchars($lead['mensagem']) . '</td>';
                    echo '<td>' . htmlspecialchars($lead['data_criacao']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include '../layout/footer.php'; ?>
</body>

</html>