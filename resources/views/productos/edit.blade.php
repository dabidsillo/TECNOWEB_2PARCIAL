@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <x-adminlte-input name="nombre" label="Nombre"
          fgroup-class="col-md-6" disable-feedback  value="{{ old('nombre', $producto->nombre) }}"/>
      @error('nombre')
            <small class="text-danger">*{{ $message }}</small>
            <br><br>
        @enderror

      <x-adminlte-textarea name="descripcion" label="Descripción"
      fgroup-class="col-md-6" disable-feedback value="{{ old('descripcion', $producto->descripcion) }}"/>

      @error('descripcion')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror
      <x-adminlte-input type="number" name="precio" label="Precio (Bs)"
      fgroup-class="col-md-6" disable-feedback value="{{ old('precio', $producto->precio) }}"/>
      @error('precio')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror
      <x-adminlte-input type="number" name="stock" label="Stock"
      fgroup-class="col-md-6" disable-feedback value="{{ old('stock', $producto->stock) }}"/>
      @error('stock')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror

      <div class="form-group col-md-6">
        <label for="exampleFormControlSelect1">Género</label>
        <select name="id_genero" class="form-control" id="exampleFormControlSelect1" required>
         @foreach ($generos as $genero)
            @if ($genero->id == $producto->id_genero)
                 <option value="{{ $genero->id }}" selected>{{ $genero->nombre }}</option>
            @else
              <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
            @endif
         @endforeach
        </select>
      </div>
      @error('id_genero')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror

      <div class="form-group col-md-6">
        <label for="exampleFormControlSelect1">Promoción</label>
        <select name="id_promocion" class="form-control" id="exampleFormControlSelect1">
          <option value="" disabled selected>Seleccionar Promoción</option>
         @foreach ($promociones as $promocion)
            @if ($promocion->id == $producto->id_promocion)
              <option value="{{ $promocion->id }}" selected>{{ $promocion->nombre }}</option>
            @else
              <option value="{{ $promocion->id }}">{{ $promocion->nombre }}</option>    
            @endif
         @endforeach
        </select>
      </div>
      @error('id_promocion')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror

      <x-adminlte-input-file name="imagen" label="Imagen (JPG, PNG, JPEG)" fgroup-class="col-md-6"
      disable-feedback value="{{ old('imagen', $producto->imagen) }}"/>
      @error('imagen')
      <small class="text-danger">*{{ $message }}</small>
      <br><br>
      @enderror
      
  </div>
  <button type="submit" class="btn btn-primary mb-4">
    Guardar Cambios
  </button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
