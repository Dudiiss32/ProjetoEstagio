@extends('analise.layout')
@extends('layouts.app')

@section('title', 'Gráficos')
@section('content')
@section('dynamic_link_name', 'Voltar') {{-- Nome do botão/link padrão --}}
@section('show-back-button')
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
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

<form action="{{route('analise.grafico')}}" method="get" class="row container center-align" >
    <div  class="input-field col s12 m4 center">
        <p>Mês de início</p>
        <select name="mesInicio" class="browser-default" id="">
            <option value="" disabled selected>Escolha um mês</option>
            
            @foreach ($mesesNomes as $num => $nome)
                <option value="{{$num}}">{{$nome}}</option>
            @endforeach
        </select>
    </div>

    <div  class="input-field col s12 m4 center">
        <p>Mês final</p>
        <select name="mesFinal" class="browser-default" id="">
            <option value="" disabled selected>Escolha um mês</option>
            @foreach ($mesesNomes as $num => $nome)
                <option value="{{$num}}">{{$nome}}</option>
            @endforeach
        </select>
    </div>

    <div class="input-field col s12 m4 center" style="display:flex; align-items:center;">
        <button class="btn waves-effect waves-light "  style="width: 100%;" type="submit">Filtrar</button>
    </div>
</form>
<!-- Dropdown Structure -->
  <div class="row container ">
      <section class="graficos col s12 m6" >            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Leads</h5>
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>           
      </section> 
      
      <section class="graficos col s12 m6">            
          <div class="grafico card z-depth-4">
              <h5 class="center"> Matrículas</h5>
          <canvas id="myChart2" width="400" height="200"></canvas> 
      </div>            
      </section>

      <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Comparativo de clientes </h5>
        <canvas id="myChart3" width="400" height="200"></canvas> 
        </div>            
      </section> 

      <section class="graficos col s12 m6" >            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Telemarketings</h5>
            <canvas id="myChart4" width="400" height="200"></canvas>
        </div>           
      </section> 
  </div>

</div>

@endsection

@push('graficos')
<script>
/* Gráfico 01 */

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! $meses !!},
        datasets: [{
            label: [{!! $leadsLabel !!}],
            data: [{!! $total_leads!!}],
           
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                     
                'rgba(255, 159, 64, 1)'
            ],
           borderWidth: 1, 
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

/* Gráfico 02 */
var ctx = document.getElementById('myChart2');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! $meses !!},
        datasets: [{
            label: {!! $matriculasLabel!!},
            data: {!! $total_matriculas !!},
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                     
                'rgba(255, 159, 64, 1)'
            ],
           borderWidth: 1, 
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
/* Gráfico 03 */
var ctx = document.getElementById('myChart3');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Matrículas', 'Agendados', 'Visitas'],
        datasets: [{
            label: 'Distribuição',
            data: {!!$total_mav!!} ,
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',                         
                'rgba(255, 159, 64)'
            ]
        }]
    }
});
/* Gráfico 04 */
var ctx = document.getElementById('myChart4');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! $meses !!},
        datasets: [{
            label: 'Comparativo de telemarketings por mês',
            data: {!! $total_telemarketings !!},
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                     
                'rgba(255, 159, 64, 1)'
            ],
           borderWidth: 1, 
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endpush