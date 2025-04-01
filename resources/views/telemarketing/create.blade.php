<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Gerenciar funcionário</h1>
    <form action="{{route('funcionario.store')}}" method="POST">
        @csrf

        <label for="">Nome:</label>
        <select name="id_user" id="">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
            
        </select>
        <br>
        <label for="">Meta de Telemarketing:</label>
        <input type="text" name="metaTele">
        <br>
        <label for="">Meta de matrícula:</label>
        <input type="text" name="metaMatricula">
        <br>
        <label for="">Comissão (%):</label>
        <input type="number" name="comissao" placeholder="Digite o valor da porcentagem. Ex: 50">
        <br>
        <input type="submit" value="Cadastrar">
        <br>
    </form>
</body>
</html>