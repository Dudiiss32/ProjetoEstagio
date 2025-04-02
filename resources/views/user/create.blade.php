@extends('layouts.app')

@section('title', 'Lista de usuários')

@section('dynamic_link_route', route('atendimento.create'))
@section('dynamic_link_name', 'Cadastrar um novo atendimento')

@section('content')
    <form action="{{route('user.store')}}" method="POST" class="form-floating">
        @csrf
        <label for="">Nome: </label>
        <input type="text"  name="name">
        <label for="">Senha: </label>
        <input type="password"  name="password">
        <button type="submit">Cadastrar usuário</button>
    </form>
@endsection