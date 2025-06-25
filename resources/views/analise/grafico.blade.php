@extends('analise.layout')
@extends('layouts.app')

@section('title', 'Gráficos')
@section('content')
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}
@section('show-back-button')
    <a href="{{ route('analise.index')}}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
@endsection

@php
    $mesesNomes = [
        '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
        '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
        '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro',
    ];
@endphp

<form action="{{ route('analise.grafico') }}" method="get" class="container my-4">
    <input type="hidden" name="funcionario" value="{{ $funcionario }}">

    <div class="row g-3 justify-content-center">
        <div class="col-12 col-md-4">
            <label for="mesInicio" class="form-label fw-bold">Mês de início</label>
            <select name="mesInicio" id="mesInicio" required>
                <option value="" disabled selected>Escolha um mês</option>
                @foreach ($mesesNomes as $num => $nome)
                    <option value="{{ $num }}">{{ $nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label for="mesFim" class="form-label fw-bold">Mês final</label>
            <select name="mesFim" id="mesFim" required>
                <option value="" disabled selected>Escolha um mês</option>
                @foreach ($mesesNomes as $num => $nome)
                    <option value="{{ $num }}">{{ $nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter me-1"></i> Filtrar
            </button>
        </div>
    </div>
</form>

<!-- Dropdown Structure -->
  <div class="row container">

    {{-- Leads --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Leads</h5>
            <canvas id="leadsChart"></canvas>
        </div>           
    </section> 

    {{-- Matrículas --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Matrículas</h5>
            <canvas id="matriculasChart"></canvas>
        </div>           
    </section> 

    {{-- Telemarketing --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Telemarketing</h5>
            <canvas id="teleChart"></canvas>
        </div>           
    </section> 

    {{-- Matrículas x Agendados x Visitas --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Distribuição: Matrículas, Agendados, Visitas</h5>
            <canvas id="mavChart"></canvas>
        </div>           
    </section> 

    {{-- Meta x Realizado - Telemarketing --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Meta x Realizado - Telemarketing</h5>
            <canvas id="metaTeleChart"></canvas>
        </div>           
    </section> 

    {{-- Meta x Realizado - Indicações --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Meta x Realizado - Indicações</h5>
            <canvas id="metaIndicacoesChart"></canvas>
        </div>           
    </section> 

    {{-- Tempo Médio --}}
    <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center">Tempo Médio - Tele x Lead</h5>
            <canvas id="tempoChart"></canvas>
        </div>           
    </section> 

    <section class="graficos col s12 m6">            
    <div class="grafico card z-depth-4">
        <h5 class="center"> Eficiência (%)</h5>
        <canvas id="eficienciaChart" width="400" height="200"></canvas>
    </div>            
    </section>


    </div>


</div>

@endsection

@push('graficos')
<script>
/* Gráfico 01 */
// Leads
new Chart(document.getElementById('leadsChart'), {
    type: 'line',
    data: {
        labels: {!! $mes !!},
        datasets: [{
            label: 'Leads',
            data: {!! $total_leads !!},
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            fill: false
        }]
    }
});

// Matrículas
new Chart(document.getElementById('matriculasChart'), {
    type: 'line',
    data: {
        labels: {!! $mes !!},
        datasets: [{
            label: 'Matrículas',
            data: {!! $total_matriculas !!},
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: false
        }]
    }
});

// Telemarketing
new Chart(document.getElementById('teleChart'), {
    type: 'line',
    data: {
        labels: {!! $mes !!},
        datasets: [{
            label: 'Telemarketing',
            data: {!! $total_telemarketings !!},
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 2,
            fill: false
        }]
    }
});

// Matrículas x Agendados x Visitas
new Chart(document.getElementById('mavChart'), {
    type: 'pie',
    data: {
        labels: ['Matrículas', 'Agendados', 'Visitas'],
        datasets: [{
            data: {!! $total_mav !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)'
            ],
            borderWidth: 1
        }]
    }
});

// Meta x Realizado - Telemarketing
new Chart(document.getElementById('metaTeleChart'), {
    type: 'bar',
    data: {
        labels: {!! $mes !!},
        datasets: [
            {
                label: 'Meta',
                data: {!! $metaTele !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            },
            {
                label: 'Realizado',
                data: {!! $total_telemarketings !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }
        ]
    }
});

// Meta x Realizado - Indicações
new Chart(document.getElementById('metaIndicacoesChart'), {
    type: 'bar',
    data: {
        labels: {!! $mes !!},
        datasets: [
            {
                label: 'Meta Indicações',
                data: {!! $metaIndicacoes !!},
                backgroundColor: 'rgba(255, 206, 86, 0.6)'
            },
            {
                label: 'Realizado',
                data: {!! $total_indicacoes !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }
        ]
    }
});

// Tempo Médio
new Chart(document.getElementById('tempoChart'), {
    type: 'bar',
    data: {
        labels: {!! $mes !!},
        datasets: [
            {
                label: 'Tempo Tele (min)',
                data: {!! $tempoTele !!},
                backgroundColor: 'rgba(153, 102, 255, 0.6)'
            },
            {
                label: 'Tempo Lead (min)',
                data: {!! $tempoLead !!},
                backgroundColor: 'rgba(255, 159, 64, 0.6)'
            }
        ]
    }
});
// Gráfico de Eficiência
new Chart(document.getElementById('eficienciaChart'), {
    type: 'bar',
    data: {
        labels: {!! $mes !!},
        datasets: [{
            label: 'Eficiência (%)',
            data: {!! $eficiencia !!},
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                title: {
                    display: true,
                    text: 'Eficiência (%)'
                }
            }
        }
    }
});


</script>
@endpush