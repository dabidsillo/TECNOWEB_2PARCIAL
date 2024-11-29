@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Lista de Categorias</h1>
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

@can('generos.create')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Crear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('generos.store') }}" method="POST">
        @csrf
        <div class="modal-body">

            <div class="row">
              <x-adminlte-input name="nombre" label="Nombre" placeholder="Camisas"
                  fgroup-class="col-md-12" disable-feedback/>
              @error('nombre')
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
    'Nombre',
    // ['label' => 'Phone', 'width' => 40],
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

// $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
//                 <i class="fa fa-lg fa-fw fa-pen"></i>
//             </button>';
// $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
//                   <i class="fa fa-lg fa-fw fa-trash"></i>
//               </button>';
// $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
//                    <i class="fa fa-lg fa-fw fa-eye"></i>
//                </button>';

$data = [];

foreach ($generos as $genero) {
    $data[] = [
        $genero->id,
        $genero->nombre,
    ];
}

$config = [
    'data' => $data,
    // 'data' => [
        // [22, 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        // [19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        // [3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
    // ],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $genero)
        <tr>
            @foreach($genero as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            <td>
              <div class="d-flex">
                @can('generos.edit')
                  <a href="{{ route('generos.edit', $genero[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                      <i class="fa fa-lg fa-fw fa-pen"></i>
                  </a>
                @endcan
                @can('generos.destroy')
                  <form action="{{ route('generos.destroy', $genero[0]) }}" method="POST">
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

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop