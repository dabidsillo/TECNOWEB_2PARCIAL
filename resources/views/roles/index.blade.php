@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de Roles</h1>
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

@can('roles.create')
<!-- Button trigger modal -->
<a href="{{ route('roles.create') }}" class="btn btn-primary mb-4">
  + Crear
</a>
@endcan

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

{{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Name',
    ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
];

$data = [];

foreach ($roles as $rol) {
    $data[] = [
        $rol->id,
        $rol->name,
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
    @foreach($config['data'] as $rol)
        <tr>
            @foreach($rol as $valor)
                <td>{!! $valor !!}</td>
            @endforeach
            @if($rol[0] != 1)
              <td>
                <div class="d-flex">
                    @can('roles.edit')
                    <a href="{{ route('roles.edit', $rol[0]) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    @endcan
                    @can('roles.destroy')
                    <form action="{{ route('roles.destroy', $rol[0]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </div>
              </td>
            @endif
          
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