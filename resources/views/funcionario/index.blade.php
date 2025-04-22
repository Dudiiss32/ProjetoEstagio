@extends('layouts.app')

@section('title', 'Lista de funcionários')


@section('link-cadastro')
    <a href="{{route('funcionario.create')}}" class="cadastro">Novo funcionário</a>
@endsection
@section('content')
    <h1>Metas</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Meta de telemarketing</th>
                <th>Meta de matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$funcionario->metaTele}}</td>
                    <td>{{$funcionario->metaMatricula}}</td>
                    <td>
                        <form action="{{route('funcionario.delete', $funcionario->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('funcionario.edit', $funcionario->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    
