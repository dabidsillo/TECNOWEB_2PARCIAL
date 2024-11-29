@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>Compras</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

<div class="card p-4"> 
  <h5>Pago de la venta</h5>
  <p>Fecha: {{ $pago->fecha }}</p>
  <p>Tipo de pago: {{$pago->tipo}} </p>
  <p>Estado del pago: <span class="badge badge-{{ $pago->estado == 'pendiente' ? "warning" : "success" }}"> {{ $pago->estado }} </span></p>
</div>

@php
$heads = [
    'ID',
    'Imagen',
    'Producto',
    'Cantidad',
    'Total',
];

$data = [];

foreach ($detalles as $detalle) {
    $data[] = [
        $detalle->id,
        $detalle->producto->imagen,
        $detalle->producto->titulo,
        $detalle->cantidad,
        $detalle->total,
    ];
}

$config = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $detalle)
        <tr>
            <td>{{$detalle[0]}}</td>
            <td>
              <img src="{{ $detalle[1] }}" alt="{{ $detalle[2] }}" style="max-width: 80px; height: auto;">
            </td>
            <td>{{$detalle[2]}}</td>
            <td>{{$detalle[3]}}</td>
            <td>{{$detalle[4]}}</td>
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop