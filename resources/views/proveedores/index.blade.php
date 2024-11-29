@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Lista del Proveedores</h1>
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

@can('proveedores.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Registrar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('proveedores.store') }}" method="POST">
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
              <x-adminlte-input  name="nit" label="Nit" placeholder="123456"
              fgroup-class="col-md-6" disable-feedback/>
              @error('nit')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror
              <x-adminlte-input  name="empresa" label="Nombre Empresa" placeholder="Amazon"
              fgroup-class="col-md-6" disable-feedback/>
              @error('empresa')
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
    'Nit',
    'Empresa',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($proveedores as $proveedor) {
    $data[] = [
        $proveedor->id,
        $proveedor->usuario->nombre,
        $proveedor->usuario->email,
        $proveedor->usuario->telefono,
        $proveedor->usuario->direccion,
        $proveedor->nit,
        $proveedor->empresa,
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
    @foreach($config['data'] as $proveedor)
        <tr>
        <td>{{ $proveedor[0] }}</td>
        <td>{{ $proveedor[1] }}</td>
        <td>{{ $proveedor[2] }}</td>
        <td>{{ $proveedor[3] }}</td>
        <td>{{ $proveedor[4] }}</td>  
        <td>{{ $proveedor[5] }}</td> 
        <td>{{ $proveedor[6] }}</td> 
            <td>
              <div class="d-flex">
                @can('proveedores.edit')
                  <a href="{{ route('proveedores.edit', $proveedor[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('proveedores.destroy')
                  <form action="{{ route('proveedores.destroy', $proveedor[0]) }}" method="POST">
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