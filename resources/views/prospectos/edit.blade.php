@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('prospectos.update', ['prospecto' => $prospecto]) }}" method="post">
        {{ csrf_field() }}
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required="" value="{{ $prospecto->nombre }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Apellido Paterno:</label>
                    <input type="text" class="form-control" name="appaterno" required="" value="{{ $prospecto->appaterno }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" name="apmaterno" value="{{ $prospecto->apmaterno }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="Hombre" {{ $prospecto->sexo == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{ $prospecto->sexo == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱RFC:</label>
                    <input type="text" class="form-control" name="rfc" required="" value="{{ $prospecto->rfc }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Email:</label>
                    <input type="text" class="form-control" name="email" required="" value="{{ $prospecto->email }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" required="" value="{{ $prospecto->telefono }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Teléfono Móvil:</label>
                    <input type="text" class="form-control" name="movil" required="" value="{{ $prospecto->movil }}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Buscar Asesor:</label>
                    <div class="input-group">
                        <input type="text" id="buscador" class="form-control" placeholder="...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-default" onclick="getAsesores()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Asesor:</label>
                    <select name="empleado_id" id="asesores" class="form-control" required="">
                        <option value="">Seleccionar</option>
                        <option value="{{ $prospecto->asesor ? $prospecto->asesor->id : "" }}" selected="">@if($prospecto->asesor) {{ $prospecto->asesor->nombre }} {{ $prospecto->asesor->paterno }} @else No tiene asignado un proscpecto @endif</option>
                        @foreach ($asesores as $asesor)
                        <option value="{{$asesor->id}}">{{ $asesor->nombre }} {{ $asesor->paterno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Ingreso mensual:</label>
                    <input type="text" class="form-control" name="ingreso" required="" value="{{ $prospecto->ingreso }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Gasto mensual:</label>
                    <input type="text" class="form-control" name="gasto" required="" value="{{ $prospecto->gasto }}">
                </div>
            </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4 offset-4 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
                <div class="col-sm-4 text-right text-danger">
                    ✱Campos Requeridos.
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    
    function getAsesores() {
        var val = $('#buscador').val();
        $.ajax({
            url: "{{ url('getAsesores') }}",
            type: "GET",
            dataType: "html",
            data: {
                query: val,
            },
        }).done(function (resultado) {
            $("#asesores").html(resultado);
        });
    }

</script>

@endsection