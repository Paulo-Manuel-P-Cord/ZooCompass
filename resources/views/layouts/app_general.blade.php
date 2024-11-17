<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Aplicativo')</title>
    <!-- Adicione estilos globais aqui -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Conteúdo -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
