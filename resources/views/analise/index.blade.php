@extends('layouts.app')

@section('title', 'Análise')

@section('content')
<h1>Análise de funcionários</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Mês</th>
            <th>Funcionário</th>
            <th>Leads</th>
            <th>Matrícula</th>
            <th>Eficiência</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leads as $lead)
            @foreach ($matriculas as $matricula)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($lead->data)->translatedFormat('F') }}
                </td>
                <td>{{$lead->user->name ?? 'Não informado'}}</td>
                <td>{{$lead->total_leads}}</td>
                <td>{{$matricula->total_matriculas}}</td>
                <td>{{$eficiencia}}%</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
<hr>
<table class="table table-striped">
    <thead>

    </thead>
    <tbody>
        
    </tbody>
</table>
@endsection