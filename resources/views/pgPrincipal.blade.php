<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    
        <h1>Funcionando :)</h1>
        <a href="{{ route('user.index') }}">Listar usuários</a>

        <form action="/enviarForm" method="POST">
            @csrf

            <label for="">Login:</label>
            <input type="text" name="name" placeholder="Digite seu nome">
            <br>
            <label for="">Senha:</label>
            <input type="password" placeholder="Digite sua senha">
            <br>
            <input type="submit" value="Logar">
        </form>
    </body> 
</html>
