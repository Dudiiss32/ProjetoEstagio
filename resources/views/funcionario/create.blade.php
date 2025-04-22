@extends('layouts.app')

@section('title', 'Gerenciar Metas')

@section('dynamic_link_route', route('funcionario.index'))
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}
@section('show-back-button')
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="card-title mb-4">Gerenciar Metas</h1>


        {{-- Formulário --}}
        <form action="{{ isset($funcionario) ? route('funcionario.update', $funcionario->id) : route('funcionario.store') }}" method="POST" class="row g-3 border p-4 rounded shadow-sm">
            @csrf
            @if (isset($funcionario))
                @method('PUT')
            @endif
            <div class="col-md-6">
                <label for="id_user" class="form-label">Nome:</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{isset($funcionario) ? 'selected': ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="metaTele" class="form-label">Meta de Telemarketing:</label>
                <input type="number" name="metaTele" class="form-control" value="{{isset($funcionario) ? $funcionario->metaTele : ''}}" id="metaTele" required>
            </div>

            <div class="col-md-6">
                <label for="metaMatricula" class="form-label">Meta de Matrícula:</label>
                <input type="number" name="metaMatricula" class="form-control" value="{{isset($funcionario) ? $funcionario->metaMatricula : ''}}" id="metaMatricula" required>
            </div>

            {{-- <div class="col-md-6">
                <label for="comissao" class="form-label">Comissão (%):</label>
                <input type="number" name="comissao" class="form-control" value="{{isset($funcionario) ? $funcionario->comissao : ''}}" id="comissao" placeholder="Digite o valor da porcentagem. Ex: 50" required>
            </div> --}}

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{isset($funcionario) ? 'Atualizar' : 'Cadastar'}}</button>
            </div>
        </form>
    </div>
@endsection
