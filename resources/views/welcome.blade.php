<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooCompass - Bem-vindo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding-top: 70px;
            color: #fff;
            background: url('{{ asset('imgs/onca.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
        }

        .navbar {
            background-color: #6e9b77;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .banner {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 1;
        }

        .banner h1 {
            font-size: 3rem;
            font-weight: bold;
            z-index: 2;
        }

        .section {
            padding: 60px 20px;
            position: relative;
            z-index: 1;
        }

        .card {
    background-color: rgba(110, 155, 119, 0.85); /* verde com transparência */
    color: white;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    backdrop-filter: blur(3px); /* efeito de desfoque elegante */
}


        .card img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #4f7158;
            color: white;
            z-index: 1;
            position: relative;
        }

        .section h2 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
        }

        .nav-link:hover {
            color: #cce3d4 !important;
        }

        .dropdown-menu {
            background-color: #5e7d63 !important;
            border-radius: 10px;
            animation: slideDown 0.3s ease-out forwards;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            color: white !important;
        }

        .dropdown-menu a:hover {
            background-color: #4f7158 !important;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="imgs/logo.png" alt="Logo do Zoológico" height="45"> Zoo Compass
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#locations">Locais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#animals">Animais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#recreations">Recreações</a></li>
                    @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <img src="{{ asset('imgs/engre.png') }}" alt="Configurações" height="28">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                            @if(Auth::user()->position == 1)
                                <li><a class="dropdown-item" href="{{ route('admin.menu') }}">Painel Admin</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Overlay escura opcional -->
<div class="overlay"></div>

<!-- Banner -->
<div class="banner">
    <h1 data-aos="fade-down">Bem-vindo ao Zoo Compass</h1>
</div>

<!-- Seções -->
<div id="about" class="section">
    <h2 data-aos="fade-up">Sobre Nós</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" data-aos="fade-up" data-aos-delay="200">
                <div class="card">
                    <img src="{{ asset('imgs/sobre-nos.jpg') }}" class="card-img-top" alt="Sobre Nós">
                    <div class="card-body">
                        <h5 class="card-title">Quem Somos</h5>
                        <p class="card-text">
                            O Zoo Compass é um espaço dedicado à preservação da fauna global, com foco em educação ambiental 
                            e diversão para toda a família.
                        </p>
                        <ul>
                            <li>Projetos de conservação ambiental</li>
                            <li>Parcerias com ONGs e institutos de pesquisa</li>
                            <li>Eventos educativos para todas as idades</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Locais -->
<div id="locations" class="section">

    <h2 data-aos="fade-up">Locais</h2>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="card">
                    <img src="{{ asset('imgs/savana.jpg') }}" class="card-img-top" alt="Savana">
                    <div class="card-body">
                        <h5 class="card-title">Savana Africana</h5>
                        <p class="card-text">Explore animais icônicos como leões, elefantes e girafas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="card">
                    <img src="{{ asset('imgs/aviario.jpg') }}" class="card-img-top" alt="Aviário">
                    <div class="card-body">
                        <h5 class="card-title">Aviário Tropical</h5>
                        <p class="card-text">Veja aves coloridas e raras em um ambiente deslumbrante.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="card">
                    <img src="{{ asset('imgs/aquario.jpg') }}" class="card-img-top" alt="Aquário">
                    <div class="card-body">
                        <h5 class="card-title">Aquário Oceânico</h5>
                        <p class="card-text">Descubra a vida marinha, incluindo peixes, tubarões e raias.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animais -->
<div id="animals" class="section">
    <h2 data-aos="fade-up">Animais</h2>
    <div class="container">
        <div class="row g-4">
            @foreach (['leao', 'tigre', 'elefante', 'girafa', 'panda', 'pinguim'] as $animal)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card">
                        <img src="{{ asset("imgs/$animal.jpg") }}" class="card-img-top" alt="{{ ucfirst($animal) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ ucfirst($animal) }}</h5>
                            <p class="card-text">Descrição do {{ $animal }} no zoológico.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Recreações -->
<div id="recreations" class="section">

    <h2 data-aos="fade-up">Recreações</h2>
    <div class="container">
        <div class="row g-4">
            @foreach([
                ['show-aves.jpg', 'Show de Aves', 'Apresentações incríveis com aves raras.'],
                ['pequenoalimentando.jpg', 'Alimentação de Animais', 'Alimente girafas e lhamas sob supervisão.'],
                ['brincadeiras-infantis.jpg', 'Brincadeiras Infantis', 'Espaços lúdicos para crianças.']
            ] as $index => [$img, $title, $desc])
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card">
                        <img src="{{ asset("imgs/$img") }}" class="card-img-top" alt="{{ $title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $title }}</h5>
                            <p class="card-text">{{ $desc }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Rodapé -->
<footer>
    &copy; 2024 ZooCompass. Todos os direitos reservados.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
</body>
</html>
