@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('clientes.update', $cliente) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $cliente->usuario->nombre) }}"/>
      @error('nombre')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
        @enderror
        <x-adminlte-input type="email"  name="email" label="Email" placeholder="juan@gmail.com"
        fgroup-class="col-md-6" disable-feedback value="{{ old('email', $cliente->usuario->email) }}"/>
        @error('email')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input type="number" name="telefono" label="Telefono" placeholder="12345678"
        fgroup-class="col-md-6" disable-feedback value="{{ old('telefono', $cliente->usuario->telefono) }}"/>
        @error('telefono')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="direccion" label="Dirección" placeholder="Av Bush 123"
        fgroup-class="col-md-6" disable-feedback value="{{ old('direccion', $cliente->usuario->direccion) }}"/>
        @error('direccion')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="ci" label="Ci" placeholder="12345678"
        fgroup-class="col-md-6" disable-feedback value="{{ old('ci', $cliente->ci) }}"/>
        @error('ci')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
      
  </div>
  <button type="submit" class="btn btn-primary mb-4">
    Guardar
  </button>
  </form>

@stop

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop