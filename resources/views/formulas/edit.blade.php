@extends('adminlte::page')

@section('title', 'Editar Fórmula')

@section('content_header')
    <h1>Editar Fórmula</h1>
@stop

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('formulas.update', $formula) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre"
          fgroup-class="col-md-6" disable-feedback value="{{ old('nombre', $formula->nombre) }}"/>
      @error('nombre')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
        @enderror
      <x-adminlte-textarea name="descripcion" label="Descripción"
      fgroup-class="col-md-6" disable-feedback>{{ old('descripcion', $formula->descripcion) }}</x-adminlte-textarea>
      @error('descripcion')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary mb-4">Guardar</button>
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
