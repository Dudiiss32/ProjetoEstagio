<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('user.create')}}">Cadastrar novo usuário</a>
    <h2>Lista de usuários</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Administrador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->isAdmin ? 'Sim' : 'Não'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>