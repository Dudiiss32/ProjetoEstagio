@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('midia.create'))
@section('dynamic_link_name', 'Cadastrar uma nova mídia')

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
    <h1>Lista de Mídias</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($midias as $midia)
                <tr>
                    <td>{{$midia->nome}}</td>
                    <td>
                        <form action="{{route('midia.delete', $midia->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('midia.edit', $midia->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
    
