@extends('layouts.home')

@section('title', 'Home')


@section('content')
    @auth
    <div class="container mt-5">
        <h1 class="card-title mb-4 text-center">Bem vindo(a) {{Auth::user()->name}}! </h1>
    </div>
  
    @else
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <p>Você precisa estar logado para acessar esta página.</p>
        <a href="{{ route('login.form') }}" class="btn btn-primary">Fazer login</a>
    </div>
    @endauth
    
@endsection
