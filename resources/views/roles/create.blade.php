@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')

@php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

<div class="">
  <form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="row">
      <x-adminlte-input name="name" label="Nombre" placeholder="Supervisor"
          fgroup-class="col-md-12" disable-feedback required/>
      @error('name')
          <small class="text-danger">*{{ $message }}</small>
          <br><br>
      @enderror
      
      @foreach($permissions as $key => $value)
      <div id="accordion{{$key}}" class="col-md-12">
          <div class="card">
            <div class="card-header" id="headingThree{{$key}}">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link collapsed uppercase" data-toggle="collapse" data-target="#collapseThree{{$key}}" aria-expanded="false" aria-controls="collapseThree{{$key}}">
                  {{ strtoupper($key) }}
                </button>
              </h5>
            </div>
            <div id="collapseThree{{$key}}" class="collapse" aria-labelledby="headingThree${{$key}}" data-parent="#accordion{{$key}}">
              <div class="card-body">
                @foreach($value as $name => $permisos)
                  <div class="collapse{{$key}}" id="collapseExample{{$name}}">
                    <div class="card card-body">
                        @foreach($permisos as $permission)
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->name}}" >
                            <label class="form-check-label" for="gridCheck" style="text-transform: capitalize">
                              {{$permission->description}}
                            </label>
                          </div>
                        @endforeach
                      </div>
                  </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>
        @endforeach

    </div>
    <button type="submit" class="btn btn-primary mb-4">
      Guardar
    </button>
  </form>
</div>

@stop

@section('footer')
<p class="text-primary">Visitas: {{ $pagina->visitas }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop