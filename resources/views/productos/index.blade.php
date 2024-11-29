@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @can('productos.create')

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
            + Registrar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <x-adminlte-input name="nombre" label="Nombre" placeholder="Camisa para niños"
                                    fgroup-class="col-md-6" disable-feedback />
                                @error('nombre')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror
                                <x-adminlte-textarea name="descripcion" label="Descripción" fgroup-class="col-md-6"
                                    disable-feedback />

                                @error('descripcion')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror
                                <x-adminlte-input type="number" name="precio" label="Precio (Bs)" placeholder="80"
                                    fgroup-class="col-md-6" disable-feedback />
                                @error('precio')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror
                                <x-adminlte-input type="number" name="stock" label="Stock" placeholder="50"
                                    fgroup-class="col-md-6" disable-feedback />
                                @error('stock')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror

                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Categoria</label>
                                    <select name="id_categoria" class="form-control" id="exampleFormControlSelect1" required>
                                        @foreach ($generos as $genero)
                                            <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_categoria')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror

                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Promoción</label>
                                    <select name="id_promocion" class="form-control" id="exampleFormControlSelect1">
                                        <option value="" disabled>Seleccion Promoción</option>
                                        @foreach ($promociones as $promocion)
                                            <option value="{{ $promocion->id }}">{{ $promocion->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_promocion')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror

                                <x-adminlte-input-file type="file" class="col-md-6" name="imagen"
                                    label="Imagen (JPG, PNG, JPEG)" placeholder="Elija una imagen..." disable-feedback />
                                @error('imagen')
                                    <small class="text-danger">*{{ $message }}</small>
                                    <br><br>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endcan

    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'ID',
            'Imagen',
            'Nombre',
            'Descripción',
            'Precio (Bs)',
            'Stock',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

        $data = [];

        foreach ($productos as $producto) {
            $data[] = [
                $producto->id,
                $producto->imagen,
                $producto->nombre,
                $producto->descripcion,
                $producto->precio,
                $producto->stock,
            ];
        }

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach ($config['data'] as $producto)
            <tr>

                <td>{{ $producto[0] }}</td>
                <td>
                    <img src="{{ $producto[1] }}" alt="{{ $producto[2] }}" style="max-width: 80px; height: auto;">
                </td>
                <td>{{ $producto[2] }}</td>
                <td>{{ $producto[3] }}</td>
                <td>{{ $producto[4] }}</td>
                <td>{{ $producto[5] }}</td<td>
                    <div class="d-flex">
                        @can('productos.edit')
                            <a href="{{ route('productos.edit', $producto[0]) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                        @endcan
                        @can('productos.destroy')
                            <form action="{{ route('productos.destroy', $producto[0]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>

            </tr>
        @endforeach
    </x-adminlte-datatable>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
