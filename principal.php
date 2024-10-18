<?php
session_start(); // Início da sessão

// Verificar se o cliente está logado
if (!isset($_SESSION['cliente'])) {
    header('Location: index.php'); // Redirecionar para login se não estiver logado
    exit();
}

// Armazenar os dados do cliente na variável
$cliente = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cliente VIP</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Header e Sidebar -->
        <?php include 'app/views/Layout/header_logado.php'; ?>
        <?php include 'app/views/Layout/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <!-- Saudação ao Cliente -->
                    <h1 class="h3 mb-4 text-gray-800">
                        Bem-vindo, <?php echo htmlspecialchars($cliente['nome']); ?>
                    </h1>

                    <div class="row">
                        <!-- Card Quadro Kanban -->
                        <div class="col-lg-3 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span>Quadro Kanban</span>
                                    <i class="fas fa-columns fa-2x"></i>
                                </div>
                                <a href="../negocio/kanban.php" class="btn btn-light mt-3">Ver</a>
                            </div>
                        </div>

                        <!-- Card Captura de Leads -->
                        <div class="col-lg-3 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span>Captura de Leads</span>
                                    <i class="fas fa-user-plus fa-2x"></i>
                                </div>
                                <a href="../lead/captura.php" class="btn btn-light mt-3">Ver</a>
                            </div>
                        </div>

                        <!-- Card Leads Capturados -->
                        <div class="col-lg-3 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span>Leads Capturados</span>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <a href="../lead/visualizar.php" class="btn btn-light mt-3">Ver</a>
                            </div>
                        </div>

                        <!-- Card Relatórios de Vendas -->
                        <div class="col-lg-3 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span>Relatórios de Vendas</span>
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <a href="../negocio/relatorios.php" class="btn btn-light mt-3">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include 'app/views/Layout/footer.php'; ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Wrapper -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>