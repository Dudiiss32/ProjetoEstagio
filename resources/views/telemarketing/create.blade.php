@extends('layouts.app')

@section('title', 'Gerenciar Teles')
@section('link-cadastro')
    <a href="{{route('telemarketing.index')}}" class="cadastro">Visualizar Teles</a>
@endsection
@section('content')

    <div class="container mt-5 d-flex flex-column gap-5">
    
        <h1>Gerenciar Teles</h1>
        @error('telefone')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        
        <form action="{{ isset($telemarketing) ? route('telemarketing.update', $telemarketing->id) : route('telemarketing.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf
            @if (isset($telemarketing))
                @method('PUT')
            @endif

            <div class="col-md-6">
                <label for="id_user" class="form-label">Nome:</label>
                <select name="id_user" id="id_user" class="form-select" required >
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{isset($telemarketing) ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" name="cliente" id="cliente" class="form-control" required value="{{isset($telemarketing) ? $telemarketing->cliente : ''}}">
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="form-control" required value="{{isset($telemarketing) ? $telemarketing->telefone : ''}}">
            </div>

            <div class="col-md-6">
                <label for="agendamento" class="form-label">Agendamento:</label>
                <input type="date" name="agendamento" id="agendamento" class="form-control" value="{{isset($telemarketing) ? $telemarketing->agendamento : ''}}"> 
            </div>

            <div class="col-md-6">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{isset($telemarketing) ? $telemarketing->hora : ''}}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
            </div>
        </form>
    </div>
@endsection
