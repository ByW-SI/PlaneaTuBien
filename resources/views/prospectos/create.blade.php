@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('prospectos.store') }}" method="post">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>✱Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required="">
                </div>
                <div class="form-group col-sm-4">
                    <label>✱Apellido Paterno:</label>
                    <input type="text" class="form-control" name="appaterno" required="">
                </div>
                <div class="form-group col-sm-4">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" name="apmaterno">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label>✱Email:</label>
                    <input type="text" class="form-control" name="email" required="">
                </div>
                <div class="form-group col-sm-4">
                    <label>Teléfono móvil:</label>
                    <input type="text" class="form-control" name="movil">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-sm-4">
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
                <div class="form-group col-sm-4">
                    <label>Asesor:</label>
                    <select name="empleado_id" id="asesores" class="form-control">
                        <option value="">Seleccionar</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4 offset-4 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Aprobar
                    </button>
                    <button type="reset" class="btn btn-danger">
                        <i class="fa fa-times"></i> No aprobar
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