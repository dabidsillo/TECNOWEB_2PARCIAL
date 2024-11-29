@extends('adminlte::page')

@section('title', 'Insumos')

@section('content_header')
    <h1>Lista de Insumos</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@can('insumos.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Crear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('insumos.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <x-adminlte-input name="nombre" label="Nombre" placeholder="Tela de Algodon"
                  fgroup-class="col-md-6" disable-feedback/>
              @error('nombre')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
              <x-adminlte-input name="cantidad" label="Cantidad" placeholder="100"
                  fgroup-class="col-md-6" disable-feedback/>
              @error('cantidad')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
              <x-adminlte-input name="precio" label="Precio" placeholder="50"
                  fgroup-class="col-md-6" disable-feedback/>
              @error('precio')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endcan

{{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Nombre',
    'Cantidad',
    'Precio',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($insumos as $insumo) {
    $data[] = [
        $insumo->id,
        $insumo->nombre,
        $insumo->cantidad,
        $insumo->precio,
    ];
}

$config = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $insumo)
        <tr>
            @foreach($insumo as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            <td>
              <div class="d-flex">
                @can('insumos.edit')
                  <a href="{{ route('insumos.edit', $insumo[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('insumos.destroy')
                  <form action="{{ route('insumos.destroy', $insumo[0]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>
                  </form>
                @endcan
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
