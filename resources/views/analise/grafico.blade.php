@extends('analise.layout')
@extends('layouts.app')

@section('title', 'Gráficos')
@section('content')

<!-- Dropdown Structure -->
  <div class="row container ">
      <section class="graficos col s12 m6" >            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Aquisição de usuários</h5>
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>           
      </section> 
      
      <section class="graficos col s12 m6">            
          <div class="grafico card z-depth-4">
              <h5 class="center"> Produtos </h5>
          <canvas id="myChart2" width="400" height="200"></canvas> 
      </div>            
      </section>

      <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Produtos </h5>
        <canvas id="myChart3" width="400" height="200"></canvas> 
        </div>            
      </section> 

      {{-- <section class="graficos col s12 m6">            
        <div class="grafico card z-depth-4">
            <h5 class="center"> Produtos </h5>
            <canvas id="myChart4" width="400" height="200"></canvas> 
        </div>            
      </section>     --}}
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
            data: [{!! $dadosLeads!!}],
           
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
            data: {!! $dadosMatriculas !!},
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
            data: {!!$dadosMatriculasTele !!} ,
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',                         
                'rgba(255, 159, 64)'
            ]
        }]
    }
});
</script>
@endpush