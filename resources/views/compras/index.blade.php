@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>Lista de Compras realizadas</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

@php
$heads = [
    'ID',
    'Fecha',
    'Hora',
    'Total',
    'Cliente',
    'Tipo de Pago',
    'Estado de Pago',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($ventas as $venta) {
    $data[] = [
        $venta->id,
        $venta->fecha,
        $venta->hora,
        $venta->total,
        $venta->cliente->usuario->nombre,
        $venta->pago->tipo,
        $venta->pago->estado,
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
    @foreach($config['data'] as $venta)
        <tr>
            <td>{{$venta[0]}}</td>
            <td>{{$venta[1]}}</td>
            <td>{{$venta[2]}}</td>
            <td>{{$venta[3]}}</td>
            <td>{{$venta[4]}}</td>
            <td>{{$venta[5]}}</td>
            <td> <span class="badge badge-{{ $venta[6] == 'pendiente' ? "warning" : "success" }}"> {{ $venta[6] }} </span> </td>
            <td>
              <div class="d-flex">
                <a href="{{ route('compras.show', $venta[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
              </div>
          </td>
          
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