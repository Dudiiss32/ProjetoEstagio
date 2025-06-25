@extends('layouts.app')

@section('title', 'Lista de leads')

@section('dynamic_link_route', route('lead.create'))
@section('dynamic_link_name', 'Cadastrar novo')

@section('content')
    {{-- Botão Voltar (opcional, se não usar botão no layout) --}}
    @section('show-back-button')
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    @endsection

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Lista de leads</h1>
    
   <form id="formFiltro" action="{{ route('lead.index') }}" method="GET" class="container mt-4">
    <div class="row g-3 align-items-end">
        {{-- Botão Mostrar Todos --}}
        <div class="col-auto">
            <input id="mostrarTds" type="submit" name="mostrarTds" class="btn btn-secondary" value="Mostrar todos">
        </div>

        {{-- Filtro por Funcionário --}}
        <div class="col-md-4">
            <label for="usuarioInput" class="form-label">Pesquisar Funcionário</label>
            <input type="text" name="usuarioInput" id="usuarioInput" class="form-control"
                value="{{ old('usuarioInput', request('usuarioInput')) }}" 
                placeholder="Digite um nome..." autocomplete="off">
        </div>

        {{-- Filtro por Mídia --}}
        <div class="col-md-4">
            <label for="midiaInput" class="form-label">Selecione a mídia</label>
            <select name="midiaInput" id="midiaInput" class="form-select">
                <option value="-1">Todas</option>
                @foreach ($midias as $midia)
                    <option value="{{ $midia->id }}" 
                        {{ (old('midiaInput', request('midiaInput')) == $midia->id) ? 'selected' : '' }}>
                        {{ $midia->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botão Filtrar --}}
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
</form>

{{-- TABELA OCUPANDO TODA A TELA --}}
<div class="container-fluid px-4">
    <div class="table-responsive w-100">
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Funcionário</th>
                    <th>Mídia</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Curso</th>
                    <th>Matrícula</th>
                    <th>Observação</th>
                    <th>N° de Indicações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td>{{ $lead->data->format('d/m/Y') }}</td>
                        <td>{{ $lead->user->name ?? 'Usuário não encontrado' }}</td>
                        <td>{{ $lead->midia->nome }}</td>
                        <td>{{ $lead->cliente }}</td>
                        @php
                            $telefone = preg_replace('/\D/', '', $lead->telefone);
                            if (strlen($telefone) === 11) {
                                $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 5).'-'.substr($telefone, 7);
                            } elseif (strlen($telefone) === 10) {
                                $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6);
                            }
                        @endphp
                        <td>{{ $telefone }}</td>
                        <td>{{ $lead->curso->nome ?? '' }}</td>
                        <td>{{ $lead->matricula ? 'Sim' : 'Não' }}</td>
                        <td>{{ $lead->observacao }}</td>
                        <td>{{ $lead->indicacoes->count() }}</td>
                        <td>
                            <form action="{{ route('lead.delete', $lead->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
