<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooCompass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #567d5f;
    color: #333;
}

.sidebar {
    position: fixed;
    top: 60px;
    left: 0;
    bottom: 0;
    background-color: #6e9b77;
    width: 250px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    padding-top: 4rem;
}

.sidebar ul.nav.flex-column {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.sidebar ul.nav.flex-column li.nav-item a.nav-link {
    color: #f8f9fa;
}

.sidebar ul.nav.flex-column li.nav-item a.nav-link:hover {
    background-color: #88b892;
}

.main-content {
    position: absolute;
    top: 60px;
    left: 250px;
    right: 0;
    bottom: 0;
    padding: 7px;
    transition: all 0.3s;
}

.navbar {
    background-color: #6e9b77;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.sidebar-brand {
    color: #f8f9fa;
    padding: 15px 20px;
    font-size: 24px;
    text-align: center;
}

.sidebar-brand img {
    width: 100px;
    display: block;
    margin: auto;
    margin-bottom: 15px;
    border-radius: 50%;
}

.sidebar ul.nav.flex-column li.nav-item {
    padding-top: 10px;
    font-size: 20px;
}

.sidebar ul li a:active {
    background-color: #88b892;
}
#navbardropmenu {
    background-color: #6e9b77;
}
.drophover:hover{
    background-color: #88b892;
}
    </style>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">
            <img src="{{ asset('imgs/logo.png') }}" alt="Logo do Zoológico" height="45"> Zoo Compass
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            paulo
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="navbardropmenu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item drophover" href="#" data-bs-toggle="modal" data-bs-target="#informacaoModal">Conta</a></li>
                            <li><a class="dropdown-item drophover" href="#" data-bs-toggle="modal" data-bs-target="#trocarSenhaModal">Trocar Senha</a></li>
                            <li><a class="dropdown-item drophover" href="#" data-bs-toggle="modal" data-bs-target="#excluirContaModal">Excluir Conta</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item drophover" href="../login/logout.php">Sair</a></li>
                            <li><a class="dropdown-item drophover" href="../index.php">Modo Usuário</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-md-block collapse" id="sidebar" style="padding-top: 20px;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin_animais.php">Gerenciar Animais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="admin_estoque.php">Gerenciar Estoque</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="admin_funcionarios.php">Gerenciar Funcionários</a>
            </li>
        </ul>
    </div>
    </header>

    <main>
        @yield('content') <!-- Aqui será injetado o conteúdo da seção 'content' -->
    </main>

    <footer>
        <!-- Rodapé -->
        <p>&copy; 2024 ZooCompass</p>
    </footer>
</body>
</html>
