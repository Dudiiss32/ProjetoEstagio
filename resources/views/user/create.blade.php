@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('atendimento.create'))
@section('dynamic_link_name', 'Cadastrar um novo atendimento')

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  

        <h1>Cadastro de Usuários</h1>
        <form action="{{isset($user) ? route('user.update', $user->id) : route('user.store')}} " method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf

            @if (isset($user))
                    @method('PUT')
            @endif

            <div class="col-md-6">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" value="{{isset($user) ? $user->name : '' }}" class="form-control" id="name" required>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" class="form-control" id="password" {{isset($user) ? '' : 'required'}} >
                @if (isset($user))
                    <small class="form-text text-muted">Deixe em branco se não deseja alterar</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmação da Senha</label>
                <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
            </div>
            

            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">{{isset($user) ? 'Atualizar' : 'Cadastrar'}}</button>
            </div>
        </form>
    </div>
@endsection
