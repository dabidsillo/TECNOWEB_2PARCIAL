@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <h1>Lista del Personal</h1>
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

@can('personles.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Registrar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('personales.store') }}" method="POST">
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
              <x-adminlte-input  name="profesion" label="Profesión" placeholder="Contador"
              fgroup-class="col-md-6" disable-feedback/>
              @error('profesion')
              <small class="text-danger">*{{ $message }}</small>
              <br><br>
              @enderror

              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Rol</label>
                <select name="rol" class="form-control" id="exampleFormControlSelect1" required>
                 @foreach ($roles as $rol)
                     <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                 @endforeach
                </select>
              </div>
              @error('rol')
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
    'Profesión',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($personales as $personal) {
    $data[] = [
        $personal->id,
        $personal->usuario->nombre,
        $personal->usuario->email,
        $personal->usuario->telefono,
        $personal->usuario->direccion,
        $personal->profesion,
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
    @foreach($config['data'] as $personal)
        <tr>
        <td>{{ $personal[0] }}</td>
        <td>{{ $personal[1] }}</td>
        <td>{{ $personal[2] }}</td>
        <td>{{ $personal[3] }}</td>
        <td>{{ $personal[4] }}</td>  
        <td>{{ $personal[5] }}</td> 
            <td>
              <div class="d-flex">
                @can('personales.edit')
                  <a href="{{ route('personales.edit', $personal[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('personales.destroy')
                  <form action="{{ route('personales.destroy', $personal[0]) }}" method="POST">
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