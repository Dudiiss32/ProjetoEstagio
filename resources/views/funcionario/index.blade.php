@extends('layouts.app')

@section('title', 'Lista de funcionários')


@section('link-cadastro')
    <a href="{{route('funcionario.create')}}" class="cadastro">Nova meta</a>
@endsection
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
    <div class="metaMes">
        <h1>Metas</h1>
        <h3>Mês atual: <b>{{ \Carbon\Carbon::now()->translatedFormat('F') }}</b></h3>        
    </div>
    
    @if ($funcionarios->isEmpty())
        <p class="alert alert-info">As metas deste mês ainda não foram preenchidas.</p>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Meta de telemarketing</th>
                <th>Tempo de telemarketing</th>
                <th>Meta de matrícula</th>
                <th>Meta de indicações</th>
                <th>Tempo de leads</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$funcionario->metaTele}}</td>
                    @php
                        $totalTele = $funcionario->tempoTele;
                        $horasTele = floor($totalTele / 60);
                        $minutosTele = $totalTele % 60;

                        $totalLead = $funcionario->tempoLead;
                        $horasLead = floor($totalLead / 60);
                        $minutosLead = $totalLead % 60;
                    @endphp
                    <td>{{$horasTele > 0 ? $horasTele . 'h' : '00:'}}{{$minutosTele}}min</td>
                    <td>{{$funcionario->metaMatricula}}</td>
                    <td>{{$funcionario->metaIndicacoes}}</td>
                    <td>{{$horasLead > 0 ? $horasLead . 'h' : '00:'}}{{$minutosLead}}min</td>
                    <td>
                        <form action="{{route('funcionario.delete', $funcionario->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('funcionario.edit', $funcionario->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
    @endif
@endsection
    
