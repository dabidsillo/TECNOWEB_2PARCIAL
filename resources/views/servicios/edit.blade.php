@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Editar Servicio</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('servicios.update', $servicio) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre" placeholder="Navidad"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $servicio->nombre) }}"/>
    @error('nombre')
          <small class="text-danger">*{{ $message }}</small>
          <br><br>
      @enderror
      <x-adminlte-input type="number" min=0 name="precio" label="Precio (Bs)" placeholder="15"
      fgroup-class="col-md-6" disable-feedback  value="{{ old('precio', $servicio->precio) }}"/>
      @error('precio')
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