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
      </div>

    </div>

@endsection