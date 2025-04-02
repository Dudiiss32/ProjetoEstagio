@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('atendimento.create'))
@section('dynamic_link_name', 'Cadastrar um novo atendimento')

@section('content')
    <div class="container mt-5">
        <h1>Cadastro de Usuários</h1>
        <form action="{{route('user.store')}}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf

            <div class="col-md-6">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">Cadastrar usuário</button>
            </div>
        </form>
    </div>
@endsection
