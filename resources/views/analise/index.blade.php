@extends('layouts.app')

@section('title', 'Análise')

@section('content')
<h1>Análise de funcionários</h1>

<table>
    <thead>
        <tr>
            <th>Mês</th>
            <th>Funcionário</th>
            <th>Atendimentos</th>
            <th>Matrícula</th>
            <th>Eficiência</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($atendimentos as $atendimento)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($atendimento->data)->translatedFormat('F') }}
                </td>
                <td>{{$atendimento->user->name ?? 'Não informado'}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection