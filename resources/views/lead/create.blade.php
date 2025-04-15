@extends('layouts.app')

@section('title', 'Gerenciar Leads')

@section('link-cadastro')
    <a href="{{route('lead.index')}}" class="cadastro">Visualizar leads</a>
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Leads</h1>
        {{-- Formulário --}}
        <form action="{{ isset($lead) ? route('lead.update', $lead->id) : route('lead.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf
            @if (isset($lead))
                @method('PUT')
            @endif
            <div class="col-md-6">
                <label for="id_user" class="form-label">Nome:</label>
                <select name="id_user" class="form-select" id="id_user" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{isset($lead) && $user->id == $lead->id_user ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" name="cliente" class="form-control" value="{{isset($lead) ? $lead->cliente : ''}}" id="cliente" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control telefone" value="{{isset($lead) ? $lead->telefone : ''}}" id="telefone" required>
            </div>

            <div class="col-md-6">
                <label for="matricula" class="form-label">Matrícula:</label>
                <select name="matricula" class="form-select" id="matricula" required>
                    <option value="1" {{isset($lead) && $lead->matricula == 1 ? 'selected' : ''}}>Sim</option>
                    <option value="0" {{isset($lead) && $lead->matricula == 0 ? 'selected' : ''}}>Não</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="observacao" class="form-label">Observação:</label>
                <input type="text" name="observacao" class="form-control" value="{{isset($lead) ? $lead->observacao : ''}}" id="observacao">
            </div>

            <div class="col-md-6">
                <label for="id_midia" class="form-label">Mídia:</label>
                <select name="id_midia" class="form-select" id="id_midia" required>
                    @foreach ($midias as $midia)
                        <option value="{{ $midia->id }}" {{isset($lead)  && $midia->id == $lead->id_midia ? 'selected' : ''}}>{{ $midia->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_curso" class="form-label">Curso:</label>
                <select name="id_curso" class="form-select" id="id_curso" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" {{isset($lead) && $curso->id == $lead->id_curso ? 'selected' : ''}}>{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-4 border-bottom pb-2">
                <h5 class="text-secondary">Indicações</h5>
            </div>
            
            <div id="indicacoes-wrapper" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome da indicação:</label>
                    <input type="text" name="indicacoes[0][nome]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telefone da indicação:</label>
                    <input type="text" name="indicacoes[0][telefone]" class="form-control telefone">
                </div>
                
                @php $count = 1; @endphp
            </div>
            <div class="col-12 mt-2">
                <button type="button" class="btn btn-outline-secondary" id="add-indicacao">
                    <i class="fa fa-plus"></i> Adicionar Indicação
                </button>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{isset($lead) ? 'Atualizar' : 'Cadastrar'}}</button>
            </div>
        </form>
    </div>
@endsection
