@extends('adminlte::page')

@section('title', 'Panel | Admin')

@section('content_header')
<h1>Panel</h1>
@stop

@php
  $pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

@section('content')
<p>Bienvenido a este hermoso panel de administración.</p>
<canvas id="bar-chart" width="800" height="450"></canvas>


<canvas id="pie-chart" width="800" height="450"></canvas>

@stop

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js') 
<!-- cambiar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> --}}

<script>
  // Bar chart
  const data = JSON.parse(`<?php echo $data; ?>`);
  const colors = JSON.parse(`<?php echo $colors; ?>`);
  const data2 = JSON.parse(`<?php echo $data2; ?>`);

  new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: data['label'],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: colors, // ["#3e95cd", "#8e5ea2","#3cba9f"]
          data: data['data']
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true  // Empieza el eje y desde cero
          }
        }]
      },
      legend: { display: false },
      title: {
        display: true,
        text: 'Productos mas vendidos'
      }
    }
  });


  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: data2['label'],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: colors,
        data: data2['data']
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Productos mas vendidos'
      }
    }
  });


</script>
@stop