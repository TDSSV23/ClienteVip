<?php
require_once '../../../config/db.php';
require_once '../../Models/Database.php';
require_once '../../Models/NegocioModel.php';
require_once '../../Controllers/NegocioController.php';

$negocioModel = new NegocioModel();
$negocioController = new NegocioController($negocioModel);

$negocios = $negocioController->obterNegocios();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadro Kanban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Quadro Kanban</h1>
        <div class="row">
            <div class="col-md-4">
                <h2>Para Fazer</h2>
                <?php foreach ($negocios as $negocio) {
                    if ($negocio['status'] == 'Para Fazer') {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($negocio['titulo']) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($negocio['descricao']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } ?>
            </div>
            <div class="col-md-4">
                <h2>Em Progresso</h2>
                <?php foreach ($negocios as $negocio) {
                    if ($negocio['status'] == 'Em Progresso') {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($negocio['titulo']) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($negocio['descricao']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } ?>
            </div>
            <div class="col-md-4">
                <h2>Concluído</h2>
                <?php foreach ($negocios as $negocio) {
                    if ($negocio['status'] == 'Concluído') {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($negocio['titulo']) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($negocio['descricao']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>