@extends('layouts.app')

@section('title', 'Lista de telemarketings')

@section('dynamic_link_route', route('telemarketing.create'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}
@section('show-back-button')
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
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
    <table class="table table-striped">
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
                    <td>{{$tele->data->format('d/m/Y')}}</td>
                    <td>{{$tele->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$tele->cliente}}</td>
                    <td>{{$tele->telefone}}</td>
                    <td>{{$tele->agendamento ? $tele->agendamento->format('d/m/Y') : ''}}</td>
                    <td>{{$tele->hora ? \Carbon\Carbon::createFromFormat('H:i:s', $tele->hora)->format('H:i') : ''}}</td>
                    <td>
                        <form action="{{route('telemarketing.delete', $tele->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('telemarketing.edit', $tele->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
@endsection