@extends('layouts.app')

@section('title', 'Gerenciar Indicações')

@section('dynamic_link_route', route('indicacao.index'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}

@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Indicações</h1>

        {{-- Formulário --}}
        <form action="{{ route('indicacao.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf

            <div class="col-md-6">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control" id="telefone" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
@endsection
