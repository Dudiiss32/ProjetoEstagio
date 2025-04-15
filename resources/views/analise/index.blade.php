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
        @foreach ($dados as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item['mes'])->translatedFormat('F') }}</td>
                <td>{{$item['nome']}}</td>
                <td>{{$item['total_leads']}}</td>
                <td>{{$item['total_matriculas']}}</td>
                <td>{{$item['eficiencia']}}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Telemarketing</th>
            <th>Matrículas</th>
            <th>Visitas</th>
            <th>Agendados</th>
            <th>Eficiência de matrículas</th>
            <th>Eficiência de visitas</th>
            <th>Eficiência de agendados</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Meta/Tele</th>
            <th>N° Atingido</th>
            <th>Falta</th>
            <th>Sobra</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Tempo/Tele</th>
            <th>Tempo/Lead</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Meta de Indicações</th>
            <th>N° de Indicação</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
@endsection