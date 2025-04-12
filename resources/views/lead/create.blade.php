@extends('layouts.app')

@section('title', 'Gerenciar Atendimentos')

@section('dynamic_link_route', route('atendimento.index'))
@section('dynamic_link_name', 'Voltar')
@section('show-back-button')
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Atendimentos</h1>
        {{-- Formulário --}}
        <form action="{{ isset($atendimento) ? route('atendimento.update', $atendimento->id) : route('atendimento.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf
            @if (isset($atendimento))
                @method('PUT')
            @endif
            <div class="col-md-6">
                <label for="id_user" class="form-label">Nome:</label>
                <select name="id_user" class="form-select" id="id_user" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{isset($atendimento) && $user->id == $atendimento->id_user ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" name="cliente" class="form-control" value="{{isset($atendimento) ? $atendimento->cliente : ''}}" id="cliente" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control" value="{{isset($atendimento) ? $atendimento->telefone : ''}}" id="telefone" required>
            </div>

            <div class="col-md-6">
                <label for="matricula" class="form-label">Matrícula:</label>
                <select name="matricula" class="form-select" id="matricula" required>
                    <option value="1" {{isset($atendimento) && $atendimento->matricula == 1 ? 'selected' : ''}}>Sim</option>
                    <option value="0" {{isset($atendimento) && $atendimento->matricula == 0 ? 'selected' : ''}}>Não</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="observacao" class="form-label">Observação:</label>
                <input type="text" name="observacao" class="form-control" value="{{isset($atendimento) ? $atendimento->observacao : ''}}" id="observacao">
            </div>

            <div class="col-md-6">
                <label for="id_midia" class="form-label">Mídia:</label>
                <select name="id_midia" class="form-select" id="id_midia" required>
                    @foreach ($midias as $midia)
                        <option value="{{ $midia->id }}" {{isset($atendimento)  && $midia->id == $atendimento->id_midia ? 'selected' : ''}}>{{ $midia->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_curso" class="form-label">Curso:</label>
                <select name="id_curso" class="form-select" id="id_curso" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" {{isset($atendimento) && $curso->id == $atendimento->id_curso ? 'selected' : ''}}>{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-4 border-bottom pb-2">
                <h5 class="text-secondary">Indicações</h5>
            </div>
            
            <div id="indicacoes-wrapper" class="row g-3">
                @php $count = 0; @endphp
                @if (isset($atendimento) && $atendimento->indicacoes->count())
                @foreach ($atendimento->indicacoes as $indicacao)
                    <input type="hidden" name="indicacoes[{{ $count }}][id]" value="{{ $indicacao->id }}">
                    <div class="col-md-6">
                        <label class="form-label">Nome da indicação:</label>
                        <input type="text" name="indicacoes[{{ $count }}][nome]" class="form-control" value="{{ $indicacao->nome }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telefone da indicação:</label>
                        <input type="text" name="indicacoes[{{ $count }}][telefone]" class="form-control" value="{{ $indicacao->telefone }}">
                    </div>
                @php $count++; @endphp
            @endforeach
                @else
                    <div class="col-md-6">
                        <label class="form-label">Nome da indicação:</label>
                        <input type="text" name="indicacoes[0][nome]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telefone da indicação:</label>
                        <input type="text" name="indicacoes[0][telefone]" class="form-control">
                    </div>
                    
                    @php $count = 1; @endphp
                @endif
            </div>
            <div class="col-12 mt-2">
                <button type="button" class="btn btn-outline-secondary" id="add-indicacao">
                    <i class="fa fa-plus"></i> Adicionar Indicação
                </button>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{isset($atendimento) ? 'Atualizar' : 'Cadastrar'}}</button>
            </div>
        </form>
    </div>
@endsection
