@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('telemarketing.create'))
@section('dynamic_link_name', 'Cadastrar novo')

@section('content')
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
                <th>Teles</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($telemarketings as $tele)
                <tr>
                    <td>{{$tele->data}}</td>
                    <td>{{$tele->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$tele->cliente}}</td>
                    <td>{{$tele->telefone}}</td>
                    <td>{{$tele->agendamento}}</td>
                    <td>{{$tele->hora}}</td>
                    <td>{{$tele->teles}}</td>
                    <td>
                        <form action="{{route('telemarketing.destroy', $tele->id)}}" method="POST" style="display: inline">
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