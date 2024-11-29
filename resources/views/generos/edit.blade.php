@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Editar categoria</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('generos.update', $genero) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre" placeholder="placeholder"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $genero->nombre) }}"/>
    @error('nombre')
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