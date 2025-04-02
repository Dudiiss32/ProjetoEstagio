@extends('layouts.app')

@section('title', 'Gerenciar Mídias')

@section('dynamic_link_route', route('midia.index'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}

@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Mídias</h1>

        {{-- Formulário --}}
        <form action="{{ route('midia.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf

            <div class="col-12">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Insira o nome da mídia" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
@endsection
