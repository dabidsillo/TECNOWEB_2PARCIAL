@extends('adminlte::page')

@section('title', 'Editar Insumo')

@section('content_header')
    <h1>Editar Insumo</h1>
@stop

@section('content')
    <form action="{{ route('insumos.update', $insumo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $insumo->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $insumo->cantidad }}" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $insumo->precio }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
