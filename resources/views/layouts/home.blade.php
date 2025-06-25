<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Akila')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
   <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
</head>
<body>
    {{-- Menu lateral --}}
    <div class="sidebar d-flex flex-column p-3 text-white" id="sidebar">
        <a href="{{ route('home') }}" class="d-inline-block text-decoration-none text-center mb-4">
            <h4 class="text-white fw-bold text-uppercase">Akila</h4>
        </a>
        <ul class="nav nav-pills flex-column">
             @can('ver-users')
                <li class="nav-item"><a class="nav-link" href="{{route('funcionario.index')}}"><i class="fa-solid fa-bullseye"></i> Metas</a></li>
            @endcan
            <li class="nav-item"><a class="nav-link" href="{{route('lead.create')}}"><i class="fa-solid fa-person-military-to-person"></i> Leads</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('telemarketing.create')}}"><i class="fa-solid fa-phone"> </i> Telemarketing</a></li>
            
            @can('ver-users')
                <li class="nav-item"><a class="nav-link" href="{{route('curso.index')}}"><i class="fa-solid fa-book"></i> Cursos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}"><i class="fa-solid fa-user"></i> Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('midia.index')}}"><i class="fa-solid fa-mobile-screen-button"> </i> Mídias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('analise.index')}}"><i class="fa-solid fa-calendar-check"></i> Análise</a></li>
            @endcan
           
            <li class="nav-item"><a class="nav-link" href="{{route('indicacao.index')}}"><i class="fa-solid fa-people-arrows"></i> Indicações</a></li>
            
        </ul>
    </div>

    {{-- Cabeçalho --}}
    <header class="bg-dark text-white p-3">
        <i class="fa-solid fa-bars menu" id="menu"></i>
        <div class="container-fluid">
            <h1 class="h4 m-0">Painel Administrativo</h1>
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="content">
        @auth
            @yield('content')
        @else
            <div class="container mt-5">
                <p>Você precisa estar logado para acessar esta página.</p>
                <a href="{{ route('login.form') }}" class="btn btn-primary">Fazer login</a>
            </div>
        @endauth
    </main>

    {{-- Rodapé --}}
    <footer class="bg-dark text-white text-center p-3">
        <p>© 2025 - Akila</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
