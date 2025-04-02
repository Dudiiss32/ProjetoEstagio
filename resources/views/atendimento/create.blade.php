@extends('layouts.app')

@section('title', 'Gerenciar Atendimentos')

@section('dynamic_link_route', route('atendimento.index'))
@section('dynamic_link_name', 'Voltar')

@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Atendimentos</h1>
        {{-- Formulário --}}
        <form action="{{ route('atendimento.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf

            <div class="col-md-6">
                <label for="id_funcionario" class="form-label">Nome:</label>
                <select name="id_funcionario" class="form-select" id="id_funcionario" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" name="cliente" class="form-control" id="cliente" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control" id="telefone" required>
            </div>

            <div class="col-md-6">
                <label for="matricula" class="form-label">Matrícula:</label>
                <select name="matricula" class="form-select" id="matricula" required>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="observacao" class="form-label">Observação:</label>
                <input type="text" name="observacao" class="form-control" id="observacao">
            </div>

            <div class="col-md-6">
                <label for="id_midia" class="form-label">Mídia:</label>
                <select name="id_midia" class="form-select" id="id_midia" required>
                    @foreach ($midias as $midia)
                        <option value="{{ $midia->id }}">{{ $midia->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_curso" class="form-label">Curso:</label>
                <select name="id_curso" class="form-select" id="id_curso" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection
