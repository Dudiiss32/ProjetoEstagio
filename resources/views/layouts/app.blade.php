<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Projeto')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>
    {{-- Menu lateral --}}
    <div class="sidebar d-flex flex-column p-3 text-white" id="sidebar">
        <h4 class="text-center text-white mb-4">Meu Projeto</h4>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item"><a class="nav-link" href="{{route('funcionario.index')}}">Lista de Funcionários</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('atendimento.index')}}">Lista de Atendimentos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('telemarketing.index')}}">Lista de Telemarketing</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('curso.index')}}">Lista de Cursos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}">Lista Usuários</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('midia.index')}}">Lista Mídias</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('indicacao.index')}}">Lista Indicações</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('analise.index')}}">Análise</a></li>
        </ul>
    </div>

    {{-- Cabeçalho --}}
    <header class="bg-dark text-white p-3">
        <i class="fa-solid fa-bars menu" id="menu"></i>
        <div class="container-fluid div-menu">
            <h1 class="h4 m-0">Painel Administrativo</h1>
            @yield('show-back-button')
            @yield('link-cadastro')
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="content mainDiv">
        @yield('content')
    </main>

    {{-- Rodapé --}}
    <footer class="bg-dark text-white text-center p-3">
        <p>© 2025 - Meu Projeto Laravel</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
