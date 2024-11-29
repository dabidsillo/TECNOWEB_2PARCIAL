@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Lista del Clientes</h1>
@stop

@section('content')
@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

@can('cliente.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Registrar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <x-adminlte-input name="nombre" label="Nombre" placeholder="Juan Perez"
                  fgroup-class="col-md-6" disable-feedback/>
              @error('nombre')
                  <small class="text-danger">*{{ $message }}</small>
                  <br><br>
              @enderror
              <x-adminlte-input type="email"  name="email" label="Email" placeholder="juan@gmail.com"
              fgroup-class="col-md-6" disable-feedback/>
              @error('email')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input type="password"  name="password" label="Password" placeholder="********"
              fgroup-class="col-md-6" disable-feedback/>

              @error('password')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input type="number" name="telefono" label="Telefono" placeholder="12345678"
              fgroup-class="col-md-6" disable-feedback/>
              @error('telefono')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input  name="direccion" label="Dirección" placeholder="Av Bush 123"
              fgroup-class="col-md-6" disable-feedback/>
              @error('direccion')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input  name="ci" label="Ci" placeholder="13475847"
              fgroup-class="col-md-6" disable-feedback/>
              @error('ci')
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
    'Email',
    'Telefono',
    'Dirección',
    'Ci',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($clientes as $cliente) {
    $data[] = [
        $cliente->id,
        $cliente->usuario->nombre,
        $cliente->usuario->email,
        $cliente->usuario->telefono,
        $cliente->usuario->direccion,
        $cliente->ci,
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
    @foreach($config['data'] as $cliente)
        <tr>
        <td>{{ $cliente[0] }}</td>
        <td>{{ $cliente[1] }}</td>
        <td>{{ $cliente[2] }}</td>
        <td>{{ $cliente[3] }}</td>
        <td>{{ $cliente[4] }}</td>  
        <td>{{ $cliente[5] }}</td> 
            <td>
              <div class="d-flex">
                @can('clientes.edit')
                  <a href="{{ route('clientes.edit', $cliente[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('clientes.destroy')
                  <form action="{{ route('clientes.destroy', $cliente[0]) }}" method="POST">
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