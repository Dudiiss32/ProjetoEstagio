<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Gerenciar Mídias</h1>
    <form action="{{route('midia.store')}}" method="POST">
        @csrf

        <label for="">Nome:</label>
        <input type="text" name="nome" placeholder="Insira o nome da mídia">
        <br>
        <input type="submit" value="Cadastrar">
        <br>
    </form>
</body>
</html>