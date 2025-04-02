<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>Laravel</title>
    </head>
    <body class="antialiased d-flex align-items-center justify-content-center">
        <div class="container mt-5 d-flex justify-content-center ">
            <div class="card p-4 shadow" style="width: 400px;">
                <h1 class="card-title mb-4 text-center">Login</h1>
    
                {{-- Formulário --}}
                <form action="/enviarForm" method="POST" class="row g-3">
                    @csrf
    
                    <div class="col-12">
                        <label for="name" class="form-label">Login:</label>
                        <input type="text" name="name" class="form-control" placeholder="Digite seu nome" required>
                    </div>
    
                    <div class="col-12">
                        <label for="password" class="form-label">Senha:</label>
                        <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                    </div>
    
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Logar</button>
                    </div>
                </form>
            </div>
        </div>
    </body> 
</html>
