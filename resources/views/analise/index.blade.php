@extends('layouts.app')

@section('title', 'Análise')

@section('content')
<h1>Análise de funcionários</h1>

<form action="{{ route('analise.index') }}" method="GET" class="mb-4">
    <div class="form-group">
        <label for="funcionario">Selecionar Funcionário:</label>
        <select name="funcionario" id="funcionario" class="form-control" onchange="this.form.submit()">
            <option value="-1" {{ request('funcionario') == '-1' ? 'selected' : '' }}>Todos</option>
            @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ request('funcionario') == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <label for="mes" class="form-label">Mês:</label>
        <select name="mesSelecionado" id="mes" class="form-select" onchange="this.form.submit()">
            <option value="">-- Todos --</option>

            @foreach ($mesesDisponiveis as $numero => $nome)
                <option value="{{ $numero }}" {{ request('mesSelecionado') == $numero ? 'selected' : '' }}>
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
                <td>{{$item['total_telemarketings']}}</td>
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
@else
    <h4>Ainda não há dados desse funcionário</h4>
@endif

@endsection