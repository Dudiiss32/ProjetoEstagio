@extends('layouts.app')

@section('title', 'Lista de telemarketings')

@section('dynamic_link_route', route('telemarketing.create'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}

@section('show-back-button')
    <a href="{{ route('telemarketing.create') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
@endsection

@section('content')
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

    <h1>Lista de Teles</h1>

    {{-- FILTROS --}}
    <form id="formFiltro" action="{{ route('telemarketing.index') }}" method="GET" class="container mt-4">
        <div class="row g-3 align-items-end justify-content-end">
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

            {{-- Botão Filtrar --}}
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    {{-- TABELA --}}
    <div class="container-fluid px-4">
        <div class="table-responsive w-100">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Funcionário</th>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Agendamento</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($telemarketings as $tele)
                        <tr>
                            <td>{{ $tele->data->format('d/m/Y') }}</td>
                            <td>{{ $tele->user->name ?? 'Usuário não encontrado' }}</td>
                            <td>{{ $tele->cliente }}</td>
                            <td>{{ $tele->telefone }}</td>
                            <td>{{ $tele->agendamento ? $tele->agendamento->format('d/m/Y') : '' }}</td>
                            <td>{{ $tele->hora ? \Carbon\Carbon::createFromFormat('H:i:s', $tele->hora)->format('H:i') : '' }}</td>
                            <td>
                                <form action="{{ route('telemarketing.delete', $tele->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                                </form>
                                <a href="{{ route('telemarketing.edit', $tele->id) }}" class="btn btn-warning">
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
