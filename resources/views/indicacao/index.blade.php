@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('indicacao.create'))
@section('dynamic_link_name', 'Cadastrar uma nova indicação')

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
                    <td>{{$indicacao->nome}}</td>
                    <td>{{$indicacao->telefone}}</td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    