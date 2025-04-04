@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('atendimento.create'))
@section('dynamic_link_name', 'Cadastrar um novo atendimento')

@section('content')
    <h1>Lista de atendimentos</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Funcionário</th>
                <th>Mídia</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Valor do curso</th>
                <th>Matrícula</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($atendimentos as $atendimento)
                <tr>
                    <td>{{$atendimento->data}}</td>
                    <td>{{$atendimento->funcionario->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$atendimento->midia->nome}}</td>
                    <td>{{$atendimento->cliente}}</td>
                    <td>{{$atendimento->telefone}}</td>
                    <td>{{$atendimento->curso->nome}}</td>
                    <td>{{$atendimento->curso->valor}}</td>
                    <td>{{$atendimento->matricula ? 'Sim' : 'Não'}}</td>
                    <td>{{$atendimento->observacao}}</td>
                    <td>
                        <form action="{{route('atendimento.delete', $atendimento->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('atendimento.edit', $atendimento->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
