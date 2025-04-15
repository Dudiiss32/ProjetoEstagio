@extends('layouts.app')

@section('title', 'Editar Indicação')

@section('content')
    <h1>Editar Indicação</h1>

    <form action="{{ route('indicacao.update', $indicacao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $indicacao->nome }}" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $indicacao->telefone }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Salvar</button>
        <a href="{{ route('indicacao.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
