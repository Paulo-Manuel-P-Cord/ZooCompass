<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooCompass - Bem-vindo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        #fundo{
            background-color: #567d5f;
            z-index: -3
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #6e9b77;
        }
        .banner {
            position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);

        }
        .card{
            background-color: #6e9b77;
        }
        .banner-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1; /* Coloca a imagem atrás do texto */
}
        .section {
            padding: 40px 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="imgs/logo.png" alt="Logo do Zoológico" height="45"> Zoo Compass
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#locations">Locais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#animals">Animais</a></li>
                    <li class="nav-item"><a class="nav-link" href="#recreations">Recreações</a></li>

                    <!-- Verificar se o usuário está logado -->
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <img src="{{ asset('imgs/engre.png') }}" alt="Configurações" height="28">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                                
                                <!-- Exibir painel admin se o usuário for admin -->
                                @if(Auth::user()->position == 1)
                                    <li><a class="dropdown-item" href="{{ route('admin.menu') }}">Painel Admin</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Links para Login e Registro se o usuário não estiver logado -->
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

<div id="fundo">
<div class="banner">
    <img src="{{ asset('imgs/onca.jpg') }}" class="banner-img">
    <h1>Bem-vindo ao Zoo Compass</h1>
</div>


<div id="about" class="section">
    <h2 class="text-center mb-4">Sobre Nós</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-white">
                <img src="{{ asset('imgs/sobre-nos.jpg') }}" class="card-img-top" alt="Sobre Nós">
                <div class="card-body">
                    <h5 class="card-title">Quem Somos</h5>
                    <p class="card-text">
                        O Zoo Compass é um espaço dedicado à preservação da fauna global, com foco em educação ambiental 
                        e diversão para toda a família. Aqui, você encontra animais de várias partes do mundo em ambientes 
                        que simulam seus habitats naturais.
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

<div id="locations" class="section">
    <h2>Locais</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/savana.jpg') }}" class="card-img-top" alt="Savana Africana">
                <div class="card-body">
                    <h5 class="card-title">Savana Africana</h5>
                    <p class="card-text">Explore animais icônicos como leões, elefantes e girafas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/aviario.jpg') }}" class="card-img-top" alt="Aviário Tropical">
                <div class="card-body">
                    <h5 class="card-title">Aviário Tropical</h5>
                    <p class="card-text">Veja aves coloridas e raras em um ambiente deslumbrante.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/aquario.jpg') }}" class="card-img-top" alt="Aquário Oceânico">
                <div class="card-body">
                    <h5 class="card-title">Aquário Oceânico</h5>
                    <p class="card-text">Descubra a vida marinha, incluindo peixes, tubarões e raias.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="animals" class="section">
    <h2>Animais</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/leao.jpg') }}" class="card-img-top" alt="Leão">
                <div class="card-body">
                    <h5 class="card-title">Leão</h5>
                    <p class="card-text">O rei da selva, símbolo de força e coragem.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/tigre.jpg') }}" class="card-img-top" alt="Tigre">
                <div class="card-body">
                    <h5 class="card-title">Tigre</h5>
                    <p class="card-text">O maior dos felinos selvagens, com sua pelagem listrada única.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/elefante.jpg') }}" class="card-img-top" alt="Elefante">
                <div class="card-body">
                    <h5 class="card-title">Elefante</h5>
                    <p class="card-text">O gigante gentil da Savana, conhecido por sua inteligência.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/girafa.jpg') }}" class="card-img-top" alt="Girafa">
                <div class="card-body">
                    <h5 class="card-title">Girafa</h5>
                    <p class="card-text">O animal mais alto do mundo, adaptado para alcançar as folhas mais altas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/panda.jpg') }}" class="card-img-top" alt="Panda">
                <div class="card-body">
                    <h5 class="card-title">Panda</h5>
                    <p class="card-text">O amado urso branco e preto, símbolo da conservação global.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('imgs/pinguim.jpg') }}" class="card-img-top" alt="Pinguim">
                <div class="card-body">
                    <h5 class="card-title">Pinguim</h5>
                    <p class="card-text">A ave que não voa, mas nada como um campeão.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recreations" class="section">
    <h2 class="text-center mb-4">Recreações</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-white">
                <img src="{{ asset('imgs/show-aves.jpg') }}" class="card-img-top" alt="Show de Aves">
                <div class="card-body">
                    <h5 class="card-title">Show de Aves</h5>
                    <p class="card-text">
                        Assista a apresentações incríveis com aves raras e aprenda sobre sua importância para o ecossistema.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white">
                <img src="{{ asset('imgs/pequenoalimentando.jpg') }}" class="card-img-top" alt="Alimentação de Animais">
                <div class="card-body">
                    <h5 class="card-title">Alimentação de Animais</h5>
                    <p class="card-text">
                        Participe de atividades interativas, como alimentar girafas, lhamas e outros animais sob supervisão.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white">
                <img src="{{ asset('imgs/brincadeiras-infantis.jpg') }}" class="card-img-top" alt="Brincadeiras Infantis">
                <div class="card-body">
                    <h5 class="card-title">Brincadeiras Infantis</h5>
                    <p class="card-text">
                        Espaços recreativos com atividades lúdicas e educativas para crianças de todas as idades.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    &copy; 2024 ZooCompass. Todos os direitos reservados.
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
