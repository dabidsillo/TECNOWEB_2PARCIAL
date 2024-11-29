@extends('adminlte::page')

@section('title', 'Promociones')

@section('content_header')
    <h1>Lista de Promociones</h1>
@stop

@section('content')

          
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@can('promociones.create')
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Crear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Promoción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('promociones.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <x-adminlte-input name="nombre" label="Nombre" placeholder="Navidad"
                  fgroup-class="col-md-12" disable-feedback/>
                  @error('nombre')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
                  @enderror
                  <x-adminlte-input type="number" min=0 name="descuento" label="Descuento" placeholder="15"
                  fgroup-class="col-md-12" disable-feedback/>
                  @error('descuento')
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
    'Descuento (%)',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($promociones as $promocion) {
    $data[] = [
        $promocion->id,
        $promocion->nombre,
        $promocion->descuento,
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
    @foreach($config['data'] as $promocion)
        <tr>
            @foreach($promocion as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            <td>
              <div class="d-flex">
                @can('promociones.edit')
                  <a href="{{ route('promociones.edit', $promocion[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('promociones.destroy')
                  <form action="{{ route('promociones.destroy', $promocion[0]) }}" method="POST">
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop