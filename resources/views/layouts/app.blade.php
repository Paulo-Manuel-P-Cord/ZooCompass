<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooCompass</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
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

        header, footer {
            flex-shrink: 0;
        }

        .content-wrapper {
            display: flex;
            flex: 1;
            min-height: 0; /* Para ajustar corretamente na responsividade */
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
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{ asset('imgs/logo.png') }}" alt="Logo do Zoológico"> Zoo Compass
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button">Paulo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><img src="{{ asset('imgs/engre.png') }}" alt="Configurações" height="28"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        

        <!-- Conteúdo Principal -->
        <div class="main-content" style="background-color: #567d5f; margin-top: 71px">
            @yield('content')
        </div>
    </div>

    <footer>
        &copy; 2024 ZooCompass. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>