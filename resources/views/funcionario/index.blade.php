@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('funcionario.create'))
@section('dynamic_link_name', 'Cadastrar um novo funcionário')

@section('content')
    <h1>Lista de funcionários</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Meta de telemarketing</th>
                <th>Meta de matrícula</th>
                <th>Comissão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$funcionario->metaTele}}</td>
                    <td>{{$funcionario->metaMatricula}}</td>
                    <td>{{$funcionario->comissao}}%</td>
                    <td>
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button> 
                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    
