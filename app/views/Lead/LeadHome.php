<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../models/Lead.php';
require_once '../../controllers/LeadController.php';

$controller = new LeadController(new LeadModel());
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Leads</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Gestão de Leads</h1>

        <!-- Formulário para cadastro/edição de Leads -->
        <div class="card mb-4">
            <div class="card-header">Cadastrar/Editar Lead</div>
            <div class="card-body">
                <?php
                // Verifica se o formulário foi enviado
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['id']) && !empty($_POST['id'])) {
                        // Atualizar lead
                        $result = $controller->atualizar($_POST['id'], $_POST);
                    } else {
                        // Cadastrar lead
                        $result = $controller->cadastrar($_POST);
                    }

                    // Exibe a mensagem de sucesso ou erro
                    echo "<div class='alert " . ($result['success'] ? "alert-success" : "alert-danger") . "'>" . $result['message'] . "</div>";
                }

                // Se o usuário clicou em "Editar", busca o lead correspondente
                $leadData = ['id' => '', 'nome' => '', 'status' => '', 'empresa' => '', 'cargo' => '', 'telefone' => ''];
                if (isset($_GET['action']) && $_GET['action'] == 'editar' && isset($_GET['id'])) {
                    $lead = $controller->buscarPorID($_GET['id']);
                    if (isset($lead['id'])) {
                        $leadData = $lead;
                    } else {
                        echo "<div class='alert alert-danger'>{$lead['message']}</div>";
                    }
                }
                ?>

                <!-- Formulário de lead -->
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?= $leadData['id']; ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $leadData['nome']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?= $leadData['status']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" value="<?= $leadData['empresa']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" value="<?= $leadData['cargo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $leadData['telefone']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>

        <!-- Tabela de leads -->
        <div class="card">
            <div class="card-header">Lista de Leads</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Status</th>
                            <th>Empresa</th>
                            <th>Cargo</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtém a lista de leads
                        $leads = $controller->listar();

                        // Verifica se a lista de leads é válida antes de tentar acessá-la
                        if (is_array($leads) && !empty($leads)) {
                            foreach ($leads as $lead) {
                                echo "<tr>";
                                echo "<td>{$lead['nome']}</td>";
                                echo "<td>{$lead['status']}</td>";
                                echo "<td>{$lead['empresa']}</td>";
                                echo "<td>{$lead['cargo']}</td>";
                                echo "<td>{$lead['telefone']}</td>";
                                echo "<td>";
                                echo "<a href='?action=editar&id={$lead['id']}' class='btn btn-warning btn-sm'>Editar</a> ";
                                echo "<a href='?action=excluir&id={$lead['id']}' class='btn btn-danger btn-sm'>Excluir</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Exibe uma mensagem se não houver leads ou se ocorrer um erro
                            echo "<tr><td colspan='6' class='text-center'>Nenhum lead encontrado ou erro ao buscar os leads.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    // Verifica se há uma ação de exclusão
    if (isset($_GET['action']) && $_GET['action'] == 'excluir' && isset($_GET['id'])) {
        // Nota: implementar a função de exclusão no controlador/modelo
        echo "<div class='alert alert-danger'>Função de exclusão ainda não implementada.</div>";
    }
    ?>

</body>

</html>