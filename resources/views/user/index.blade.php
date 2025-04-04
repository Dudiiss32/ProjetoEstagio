@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('user.create'))
@section('dynamic_link_name', 'Cadastrar novo usuário')

@section('content')
    <h2>Lista de usuários</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Administrador</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->isAdmin ? 'Sim' : 'Não'}}</td>
                    <td>
                        <form action="{{route('user.delete', $user->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


