<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mídias</title>
</head>
<body>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{route('midia.create')}}">Cadastrar uma nova mídia</a>
    <h1>Lista de Mídias</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($midias as $midia)
                <tr>
                    <td>{{$midia->nome}}</td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
</body>
</html>