<header class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid">
        <button class="btn btn-link d-md-none">
            <i class="fa fa-bars"></i>
        </button>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                    <span class="mr-2 d-none d-lg-inline text-gray-600">Olá, <?php echo htmlspecialchars($cliente['nome']); ?></span>
                    <img class="img-profile rounded-circle" src="/public/img/user-default.png">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="../perfil.php">Perfil</a>
                    <a class="dropdown-item" href="#">Configurações</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</header>