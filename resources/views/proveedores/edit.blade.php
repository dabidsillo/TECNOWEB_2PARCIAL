@extends('adminlte::page')

@section('title', 'Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $proveedor->usuario->nombre) }}"/>
      @error('nombre')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
        @enderror
        <x-adminlte-input type="email"  name="email" label="Email" placeholder="juan@gmail.com"
        fgroup-class="col-md-6" disable-feedback value="{{ old('email', $proveedor->usuario->email) }}"/>
        @error('email')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input type="number" name="telefono" label="Telefono" placeholder="12345678"
        fgroup-class="col-md-6" disable-feedback value="{{ old('telefono', $proveedor->usuario->telefono) }}"/>
        @error('telefono')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="direccion" label="Dirección" placeholder="Av Bush 123"
        fgroup-class="col-md-6" disable-feedback value="{{ old('direccion', $proveedor->usuario->direccion) }}"/>
        @error('direccion')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="nit" label="Nit" placeholder="123456"
        fgroup-class="col-md-6" disable-feedback value="{{ old('nit', $proveedor->nit) }}"/>
        @error('nit')
        <small class="text-danger">*{{ $message }}</small>
        <br><br>
        @enderror
        <x-adminlte-input  name="empresa" label="Empresa" placeholder="Amazon"
        fgroup-class="col-md-6" disable-feedback value="{{ old('nit', $proveedor->empresa) }}"/>
        @error('empresa')
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