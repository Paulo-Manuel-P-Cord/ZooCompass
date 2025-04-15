<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooCompass</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery + Plugins -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Estilos customizados -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #567d5f;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .bg-light-success {
            background-color: rgba(114, 161, 133, 0.53);
            /* tom bem leve de verde */
        }

        header,
        footer {
            flex-shrink: 0;
        }

        .content-wrapper {
            display: flex;
            flex: 1;
            min-height: 0;
        }

        .ul.nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ul.nav li {
            padding: 10px 20px;
        }

        .ul.nav li a {
            color: #f8f9fa;
            text-decoration: none;
        }

        .ul.nav li a:hover {
            background-color: #88b892;
            border-radius: 5px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            overflow-y: auto;
        }

        .navbar {
            background-color: #6e9b77;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 45px;
        }

        .dropdown-menu {
            display: none;
            position: static;
            float: none;
            background-color: #567d5f;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 0;
        }

        .dropdown-menu .dropdown-item {
            color: #f8f9fa;
            padding: 0.5rem 1rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #88b892;
            color: #fff;
        }

        .nav-link,
        .navbar-brand {
            color: #fff;
            cursor: pointer;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #cce3d3;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            margin-left: 8px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #6e9b77;
            color: white;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.menu') }}">
                    <img src="{{ asset('imgs/logo.png') }}" alt="Logo do Zoológico"> Zoo Compass
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        @if (Auth::user()->position == 1)
                            <!-- Animais -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle manual-dropdown" id="animalsMenu">Animais</a>
                                <div class="dropdown-menu" aria-labelledby="animalsMenu">
                                    <a class="dropdown-item" href="{{ route('animals.index') }}">Ver Animais</a>
                                </div>
                            </li>

                            <!-- Trabalhadores -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle manual-dropdown" id="workersMenu">Trabalhadores</a>
                                <div class="dropdown-menu" aria-labelledby="workersMenu">
                                    <a class="dropdown-item" href="{{ route('workers.index') }}">Ver Trabalhadores</a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" href="{{ route('positions.index') }}">Ver Cargos</a>
                                </div>
                            </li>

                            <!-- Estoque -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle manual-dropdown" id="stockMenu">Estoque</a>
                                <div class="dropdown-menu" aria-labelledby="stockMenu">
                                    <a class="dropdown-item" href="{{ route('stores.index') }}">Ver Estoque</a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" href="{{ route('stock_categories.index') }}">Categorias de
                                        Estoque</a>
                                </div>
                            </li>

                            <!-- Manutenções -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle manual-dropdown" id="maintenanceMenu">Manutenções</a>
                                <div class="dropdown-menu" aria-labelledby="maintenanceMenu">
                                    <a class="dropdown-item" href="{{ route('maintenances.index') }}">Ver Manutenções</a>
                                </div>
                            </li>
                        @endif

                        @if (Auth::user()->position == 0)
                            <!-- Botão Voltar -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('welcome') }}">
                                    <i class="fas fa-arrow-left"></i> Voltar
                                </a>
                            </li>
                        @endif

                        <!-- Usuário -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle manual-dropdown" id="userMenu">
                                {{ Auth::user()->name }}
                                <img src="{{ asset('imgs/engre.png') }}" alt="Configurações" height="28">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userMenu">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                                <a class="dropdown-item" href="{{ route('welcome') }}">Voltar</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="content-wrapper">
        <div class="main-content" style="background-color: #567d5f; margin-top: 71px">
            @yield('content')
        </div>
    </div>

    <footer>
        &copy; 2024 ZooCompass. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery Animations -->
    <script>
        $(document).ready(function () {
            $('.manual-dropdown').on('click', function (e) {
                e.preventDefault();
                const $menu = $(this).next('.dropdown-menu');

                // Fecha os outros
                $('.dropdown-menu').not($menu).slideUp(200);

                // Alterna o atual
                $menu.stop(true, true).slideToggle(200);
            });

            // Fecha ao clicar fora
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.nav-item.dropdown').length) {
                    $('.dropdown-menu').slideUp(200);
                }
            });
        });
    </script>

</body>

</html>