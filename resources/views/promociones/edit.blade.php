@extends('adminlte::page')

@section('title', 'Promociones')

@section('content_header')
    <h1>Editar Promoción</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp


  <form action="{{ route('promociones.update', $promocion) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre" placeholder="Navidad"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $promocion->nombre) }}"/>
    @error('nombre')
          <small class="text-danger">*{{ $message }}</small>
          <br><br>
      @enderror
      <x-adminlte-input type="number" min=0 name="descuento" label="Descuento" placeholder="15"
      fgroup-class="col-md-6" disable-feedback  value="{{ old('descuento', $promocion->descuento) }}"/>
      @error('descuento')
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