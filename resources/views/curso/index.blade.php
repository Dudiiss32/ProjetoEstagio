@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('curso.create'))
@section('dynamic_link_name', 'Cadastrar um novo curso')

@section('content')
    <h1>Lista de cursos</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Horas</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{$curso->nome}}</td>
                    <td>{{$curso->horas}}</td>
                    <td>{{$curso->valor}}</td>
                    <td>
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button> 
                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    
