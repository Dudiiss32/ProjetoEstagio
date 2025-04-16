@extends('layouts.app')

@section('title', 'Gerenciar Teles')
@section('link-cadastro')
    <a href="{{route('telemarketing.index')}}" class="cadastro">Visualizar Teles</a>
@endsection
@section('content')

<form action="{{route('analise.store')}}" method="POST" class="mb-4">
    @csrf
    <div class="form-group">
        <label for="funcionario">Selecionar Funcionário:</label>
        <select name="user_id" id="funcionario" class="form-control" onchange="this.form.submit()">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
</form>

@endsection