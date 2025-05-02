@extends('layouts.app')

@section('title', 'Lista de indicações')

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
    <h1>Lista de indicações</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Funcionário</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($indicacoes as $indicacao)
                <tr>
                    <td>{{$indicacao->lead->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$indicacao->nome}}</td>
                    <td>{{$indicacao->telefone}}</td>
                    <td>
                        <form action="{{route('indicacao.delete', $indicacao->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('indicacao.edit', $indicacao->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
@endsection
    