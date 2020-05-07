@extends('principal')
@section('content')

<div class="container">
    <h4 class="text-uppercase text-muted">
        {{$titulo}}
    </h4>
    <div class="row">
        <div class="col-12-col-md-4"></div>
        <div class="col-12-col-md-4">
            <div class="card card-default">
                <form method="POST" action="{{$edit ? route($edit,['precarga'=>$precarga]) : route($guardar) }}">
                    @csrf
                    @if ($edit)
                    @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row row-group">
                            <div class="col-12 form-group">
                                <label class="text-uppercase" for="nombre">Nombre:</label>
                                <input class="form-control" type="text" value="{{$precarga->nombre}}" name="nombre"
                                    required>
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-uppercase" for="nombre">Jefe:</label>
                                <select name="jefe_id" id="" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach ($empleados as $empleado)
                                    <option value="{{$empleado->id}}">{{$empleado->nombre}} {{$empleado->paterno}} {{$empleado->materno}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-uppercase" for="descripcion">Descripción:</label>
                                <textarea class="form-control"
                                    name="descripcion">{{ $precarga->etiqueta ? $precarga->etiqueta : $precarga->descripcion}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success rounded-0" id="basic-addon1">
                                <i class="fas fa-save"></i>
                                <strong> Guardar</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12-col-md-4"></div>
    </div>
</div>


@endsection