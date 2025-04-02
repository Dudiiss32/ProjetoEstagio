<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Projeto')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"> 
</head>
<body>
    {{-- Cabeçalho comum para todas as páginas --}}
    <header class="bg-dark text-white p-3 mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="#">Meu Projeto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{route('funcionario.index')}}">Lista de Funcionários</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('atendimento.index')}}">Lista de Atendimentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('telemarketing.index')}}">Lista de Telemarketing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('curso.index')}}">Lista de Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}">Gerenciar Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('midia.index')}}">Gerenciar Mídias</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('indicacao.index')}}">Gerenciar Indicações</a></li>
                </ul>
            </div>
        </nav>
    </header>

    {{-- Conteúdo dinâmico da página --}}
    <div class="container mb-5">
        <a class="btn btn-primary mb-3" href="@yield('dynamic_link_route', '#')">@yield('dynamic_link_name', 'Link Padrão')</a>
        @yield('content')
    </div>

    {{-- Rodapé comum para todas as páginas --}}
    <footer class="bg-dark text-white text-center p-3">
        <p>© 2025 - Meu Projeto Laravel</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
