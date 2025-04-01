<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Funcionários</title>
</head>
<body>
    <a href="{{route('funcionario.create')}}">Cadastrar um novo atendimento</a>
    <h1>Lista de atendimentos</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Meta de telemarketing</th>
                <th>Meta de matrícula</th>
                <th>Comissão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$funcionario->metaTele}}</td>
                    <td>{{$funcionario->metaMatricula}}</td>
                    <td>{{$funcionario->comissao}}%</td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
</body>
</html>