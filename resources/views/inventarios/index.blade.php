@extends('adminlte::page')

@section('title', 'Inventarios')

@section('content_header')
    <h1>Lista de Inventarios</h1>
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

@can('inventarios.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Crear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('inventarios.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <x-adminlte-input name="nombre" label="Nombre" placeholder="Delivery"
                  fgroup-class="col-md-12" disable-feedback/>
              @error('nombre')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
              <x-adminlte-input type="number" min=0 name="cantidad_disponible" label="Cantidad Disponible" placeholder="15"
              fgroup-class="col-md-12" disable-feedback/>
              @error('cantidad_disponible')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
            </div>

            <div class="form-group col-md-12">
              <label for="exampleFormControlSelect1">Producto</label>
              <select name="id_producto" class="form-control" id="exampleFormControlSelect1">
                @foreach ($productos as $producto)
                   <option value="{{ $producto->id }}">{{ $producto->titulo }}</option>
               @endforeach
              </select>
            </div>
            @error('id_producto')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
            @enderror

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
    'Cantidad Disponible',
    'Producto',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($inventarios as $inventario) {
    $data[] = [
        $inventario->id,
        $inventario->nombre,
        $inventario->cantidad_disponible,
        $inventario->producto->titulo,
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
    @foreach($config['data'] as $inventario)
        <tr>
            @foreach($inventario as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            <td>
              <div class="d-flex">
                @can('inventarios.edit')
                  <a href="{{ route('inventarios.edit', $inventario[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('inventarios.destroy')
                  <form action="{{ route('inventarios.destroy', $inventario[0]) }}" method="POST">
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