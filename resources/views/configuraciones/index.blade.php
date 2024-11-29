@extends('adminlte::page')

@section('title', 'Configuración')

@section('content_header')
    <h1>Configuración</h1>
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


<form action="{{ route('configuraciones.store') }}" method="POST">
  @csrf

  <div class="row">

  <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">Tema</label>
    <select name="tema" class="form-control" id="exampleFormControlSelect1" required>
     <option value="adulto">Adulto</option>
     <option value="joven">Joven</option>
     <option value="nino">Niño</option>
    </select>
  </div>

  <div class="form-group col-md-12">
    <div class="form-group form-check">
      <input name="modo_oscuro" type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Modo Oscuro</label>
    </div>
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



@stop

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop