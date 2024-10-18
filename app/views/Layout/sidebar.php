<header class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid">
        <!-- Botão para abrir o menu lateral em telas pequenas -->
        <button class="btn btn-link d-md-none">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Menu do usuário logado -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                    <span class="mr-2 d-none d-lg-inline text-gray-600">
                        Olá, <?php echo htmlspecialchars($cliente['nome']); ?>
                    </span>
                    <img class="img-profile rounded-circle" src="/ClienteVip/public/img/user-default.png" alt="User Profile">
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <!-- Links ajustados com caminho absoluto -->
                    <a class="dropdown-item" href="/ClienteVip/app/Views/cliente/perfil.php">Perfil</a>
                    <a class="dropdown-item" href="#">Configurações</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/ClienteVip/app/Views/cliente/logout.php">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</header>