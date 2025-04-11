@extends('layouts.home')

@section('title', 'Home')


@section('content')
    @auth
    <div class="container mt-5">
            <h1 class="card-title mb-4 text-center">Bem vindo(a) {{auth()->user()->name}}! </h1>
    </div>
    @else
    <div class="container mt-5">
        <a href="{{route('')}}">Login</a>
        <h1 class="card-title mb-4 text-center">Login</h1>
    </div>
    @endauth
@endsection
