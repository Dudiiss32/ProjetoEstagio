<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Gerenciar atendimentos</h1>
    <form action="{{route('atendimento.store')}}" method="POST">
        @csrf

        <label for="">Nome:</label>
        <select name="id_funcionario" id="">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <br>
        <label for="">Cliente:</label>
        <input type="text" name="cliente">
        <br>
        <label for="">Telefone:</label>
        <input type="text" name="telefone">
        <br>
        <label for="">Matrícula:</label>
        <select name="matricula" id="">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <br>
        <label for="">Observação:</label>
        <input type="text" name="observacao">
        <br>
        <label for="">Mídia:</label>
        <select name="id_midia" id="">
            @foreach ($midias as $midia)
                <option value="{{$midia->id}}">{{$midia->nome}}</option>
            @endforeach
        </select>
        <br>
        <label for="">Curso:</label>
        <select name="id_curso" id="">
            @foreach ($cursos as $curso)
                <option value="{{$curso->id}}">{{$curso->nome}}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Salvar">
        <br>
    </form>
</body>
</html>