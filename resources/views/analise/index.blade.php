@extends('layouts.app')

@section('title', 'Análise')

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
<h1>Análise de funcionários</h1>

<form action="{{ route('analise.index') }}" method="GET" class="mb-4">
    <div class="form-group">
        <label for="funcionario">Selecionar Funcionário:</label>
        <select name="funcionario" id="funcionario" class="form-control" onchange="this.form.submit()">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('funcionario') == $user->id || (request('funcionario') == null && $loop->first) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <label for="mes" class="form-label">Mês:</label>
        <select name="mesSelecionado" id="mes" class="form-select" onchange="this.form.submit()">
            @foreach ($mesesDisponiveis as $numero => $nome)
                <option value="{{ $numero }}" {{ request('mesSelecionado') == $numero || (request('mesSelecionado') == null && $numero == date('n')) ? 'selected' : '' }}>
                    {{ $nome }}
                </option>
            @endforeach
        </select>

    </div>
</form>

@if (@isset($dados) && count($dados) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mês</th>
                <th>Funcionário</th>
                <th>Leads</th>
                <th>Matrícula</th>
                <th>Eficiência (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
                <tr>
                    <td>{{$mesesDisponiveis[str_pad($item['mes'], 2, '0', STR_PAD_LEFT)] }}</td>
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
                <th>Eficiência Matrículas</th>
                <th>Eficiência Visitas</th>
                <th>Eficiência Agendados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
                @php
                    $telemarketing = $item['total_telemarketings'] ?? 0;
                    $matriculasTele = $item['total_matriculas_tele'] ?? 0;
                    $visitas = $item['total_visitas'] ?? 0;
                    $agendados = $item['total_agendados'] ?? 0;
                    
                    $eficienciaMatriculas = $telemarketing > 0 ? round(($matriculasTele / $telemarketing) * 100, 2) : 0;
                    $eficienciaVisitas = $telemarketing > 0 ? round(($visitas / $telemarketing) * 100, 2) : 0;
                    $eficienciaAgendados = $telemarketing > 0 ? round(($agendados / $telemarketing) * 100, 2) : 0;
                @endphp
                <tr>
                    <td>{{ $telemarketing }}</td>
                    <td>{{ $matriculasTele }}</td>
                    <td>{{ $visitas }}</td>
                    <td>{{ $agendados }}</td>
                    <td>{{ $eficienciaMatriculas }}%</td>
                    <td>{{ $eficienciaVisitas }}%</td>
                    <td>{{ $eficienciaAgendados }}%</td>
                </tr>
            @endforeach
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
                @php
                    $falta = max($item['metaTele'] - $item['total_telemarketings'], 0);
                    $sobra =  max($item['total_telemarketings'] - $item['metaTele'], 0);
                @endphp
                <td>{{$item['metaTele']}}</td>
                <td>{{$item['total_telemarketings']}}</td>
                <td>{{$falta}}</td>
                <td>{{$sobra}}</td>
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
                <th>N° de Indicações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$item['metaIndicacoes']}}</td>
                <td>{{$item['total_indicacoes']}}</td>
            </tr>
        </tbody>
    </table>
@else
    <h4>Ainda não há dados desse funcionário</h4>
@endif

@endsection