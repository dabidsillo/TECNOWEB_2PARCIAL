@extends('adminlte::page')

@section('title', 'Personal')

@section('content_header')
    <h1>Editar Personal</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('personales.update', $personal) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $personal->usuario->nombre) }}"/>
      @error('nombre')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
        @enderror
        <x-adminlte-input type="email"  name="email" label="Email" placeholder="juan@gmail.com"
        fgroup-class="col-md-6" disable-feedback value="{{ old('email', $personal->usuario->email) }}"/>
        @error('email')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input type="number" name="telefono" label="Telefono" placeholder="12345678"
        fgroup-class="col-md-6" disable-feedback value="{{ old('telefono', $personal->usuario->telefono) }}"/>
        @error('telefono')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="direccion" label="Dirección" placeholder="Av Bush 123"
        fgroup-class="col-md-6" disable-feedback value="{{ old('direccion', $personal->usuario->direccion) }}"/>
        @error('direccion')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="profesion" label="Profesión" placeholder="Contador"
        fgroup-class="col-md-6" disable-feedback value="{{ old('profesion', $personal->profesion) }}" required/>
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
  <button type="submit" class="btn btn-primary mb-4">
    Guardar
  </button>
  </form>

  @section('footer')
  <p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
  @stop

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop