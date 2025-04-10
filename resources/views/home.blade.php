@extends('layouts.home')

@section('title', 'Home')


@section('content')
    <div class="container mt-5">
            <h1 class="card-title mb-4 text-center">Bem vindo(a) {{auth()->user()->name}}! </h1>
    </div>
@endsection
