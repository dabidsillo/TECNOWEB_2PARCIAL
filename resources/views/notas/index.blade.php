@extends('adminlte::page')

@section('title', 'Notas de ingreso')

@section('content_header')
    <h1>Lista de Notas de ingreso</h1>
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

@can('nota-de-ingresos.create')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Crear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nota de ingreso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('nota-de-ingresos.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <x-adminlte-input id="cantidad" type="number" min=0 name="cantidad" label="Cantidad" placeholder="10"
                  fgroup-class="col-md-6" disable-feedback/>
              @error('cantidad')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
              <x-adminlte-input id="costo" type="number" min=0 name="costo" label="Costo (Bs)" placeholder="10"
              fgroup-class="col-md-6" disable-feedback/>
              @error('costo')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input type="number" id="total" min=0 name="total" label="Total (Bs)" placeholder="0"
              fgroup-class="col-md-6" disable-feedback disabled/>
              @error('total')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror

              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Inventario</label>
                <select name="id_inventario" class="form-control" id="exampleFormControlSelect1">
                  @foreach ($inventarios as $inventario)
                     <option value="{{ $inventario->id }}">{{ $inventario->nombre }}</option>
                 @endforeach
                </select>
              </div>
              @error('id_inventario')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror

              <div class="form-group col-md-6 ">
                <label for="exampleFormControlSelect1">Proveedor</label>
                <select name="id_proveedor" class="form-control" id="exampleFormControlSelect1">
                  @foreach ($proveedores as $proveedor)
                     <option value="{{ $proveedor->id }}">{{ $proveedor->usuario->nombre }}</option>
                 @endforeach
                </select>
              </div>
              @error('id_proveedor')
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
    'Fecha',
    'Cantidad',
    'Costo (Bs)',
    'Total (Bs)',
    'Inventario',
    'Proveedor',
    // ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($notas as $notas) {
    $data[] = [
        $notas->id,
        $notas->fecha,
        $notas->cantidad,
        $notas->costo,
        $notas->total,
        $notas->inventario->nombre,
        $notas->proveedor->usuario->nombre,
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
    @foreach($config['data'] as $notas)
        <tr>
            @foreach($notas as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            {{-- <td>
              <div class="d-flex">
                  <a href="{{ route('nota-de-ingreso.edit', $notas[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                  <form action="{{ route('nota-de-ingreso.destroy', $notas[0]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>
                  </form>
              </div>
          </td> --}}
          
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
<script>

document.addEventListener('DOMContentLoaded', function () {
        const cantidadInput = document.getElementById('cantidad');
        const costoInput = document.getElementById('costo');
        const totalInput = document.getElementById('total');

        [cantidadInput, costoInput].forEach(function (input) {
            input.addEventListener('input', function () {
                // Obtener los valores de cantidad y costo
                const cantidad = parseFloat(cantidadInput.value) || 0;
                const costo = parseFloat(costoInput.value) || 0;

                const total = cantidad * costo;

                // Actualizar el valor del input de total
                totalInput.value = total;
            });
        });
    });
</script>

@stop