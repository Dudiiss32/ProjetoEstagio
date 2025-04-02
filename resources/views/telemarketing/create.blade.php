<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Gerenciar teles</h1>
    <form action="{{route('telemarketing.store')}}" method="POST">
        @csrf

        <label for="">Nome:</label>
        <select name="id_user" id="">
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
        <label for="">Agendamento:</label>
        <input type="date" name="agendamento">
        <br>
        <label for="">Observação:</label>
        <input type="text" name="observacao">
        <br>
        <label for="">Hora:</label>
        <input type="time" name="hora">
        <br>
        <label for="">Teles:</label>
        <input type="number" name="teles">
        <br>
        <input type="submit" value="Salvar">
        <br>
    </form>
</body>
</html>