@extends('layouts.app')

@section('title', 'Gerenciar Curso')

@section('dynamic_link_route', route('curso.index'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}
@section('show-back-button')
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Curso</h1>

        {{-- Formulário --}}
        <form action="{{ isset($curso) ? route('curso.update', $curso->id) : route('curso.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf
            @if (isset($curso))
                @method('PUT')
            @endif
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" value="{{isset($curso) ? $curso->nome : ''}}" id="nome" required>
            </div>

            <div class="col-md-6">
                <label for="horas" class="form-label">Horas:</label>
                <input type="number" name="horas" class="form-control" value="{{isset($curso) ? $curso->horas : ''}}" id="horas" required>
            </div>

            <div class="col-md-6">
                <label for="valor" class="form-label">Valor:</label>
                <input type="text" name="valor" class="form-control" value="{{isset($curso) ? number_format($curso->valor, 2, ',', '.') : ''}}" id="valor" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{isset($curso) ? 'Atualizar' : 'Cadastrar'}}</button>
            </div>
        </form>
    </div>
@endsection
