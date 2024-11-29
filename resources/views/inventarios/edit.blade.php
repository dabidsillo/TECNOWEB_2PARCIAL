@extends('adminlte::page')

@section('title', 'Inventarios')

@section('content_header')
    <h1>Editar Inventario</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

  <form action="{{ route('inventarios.update', $inventario) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre" placeholder="Navidad"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $inventario->nombre) }}"/>
      @error('nombre')
          <small class="text-danger">*{{ $message }}</small>
          <br><br>
      @enderror
      <x-adminlte-input type="number" min=0 name="cantidad_disponible" label="Cantidad" placeholder="15"
      fgroup-class="col-md-6" disable-feedback  value="{{ old('cantidad_disponible', $inventario->cantidad_disponible) }}"/>
      @error('cantidad_disponible')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
      @enderror

      <div class="form-group col-md-12">
        <label for="exampleFormControlSelect1">Producto</label>
        <select name="id_producto" class="form-control" id="exampleFormControlSelect1" value="{{ old('id_producto', $inventario->id_producto) }}">
          @foreach ($productos as $producto)
          @if ($producto->id == $inventario->id_producto)
           <option selected value="{{ $producto->id }}">{{ $producto->titulo }}</option>
          @else
          <option value="{{ $producto->id }}">{{ $producto->titulo }}</option>
          @endif
            
         @endforeach
        </select>
      </div>
      @error('id_producto')
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