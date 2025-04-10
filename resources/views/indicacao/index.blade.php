@extends('layouts.app')

@section('title', 'Lista de indicações')

{{-- 
@section('link-cadastro')
    <a href="{{route('indicacao.create')}}" class="cadastro">Nova indicação</a>
@endsection --}}
@section('content')
    <h1>Lista de indicações</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($indicacoes as $indicacao)
                <tr>
                    <td>{{$indicacao->indicacao_nome}}</td>
                    <td>{{$indicacao->indicacao_telefone}}</td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    