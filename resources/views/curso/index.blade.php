@extends('layouts.app')

@section('title', 'Lista de cursos')


@section('link-cadastro')
    <a href="{{route('curso.create')}}" class="cadastro">Novo curso</a>
@endsection
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
                    <td>{{$curso->horas}}h</td>
                    <td>R${{ number_format($curso->valor, 2, ',', '.')}}</td>
                    <td>
                        <form action="{{route('curso.delete', $curso->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('curso.edit', $curso->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    
