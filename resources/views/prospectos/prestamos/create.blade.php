@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Nombre:</label>
                <dd>{{ $prospecto->nombre }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Paterno:</label>
                <dd>{{ $prospecto->appaterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Materno:</label>
                <dd>{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Sexo:</label>
                <dd>{{ $prospecto->sexo }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>RFC:</label>
                <dd>{{ $prospecto->rfc }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Email:</label>
                <dd>{{ $prospecto->email }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono:</label>
                <dd>{{ $prospecto->telefono }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono Móvil:</label>
                <dd>{{ $prospecto->movil }}</dd>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Asesor:</label>
                <dd>{{ $prospecto->asesor->nombre }} {{ $prospecto->asesor->paterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Ingreso Mensual:</label>
                <dd>{{ $prospecto->ingreso }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Gasto Mensual:</label>
                <dd>{{ $prospecto->gasto }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.documentos.index', ['prospecto' => $prospecto]) }}">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}">Préstamos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Datos del Préstamo:</h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('prospectos.prestamos.store', ['prospecto' => $prospecto]) }}" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Préstamo:</label>
                            <input type="number" name="prestamo" class="form-control" required="" id="prestamo">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Meses:</label>
                            <select name="meses" class="form-control" id="meses">
                                <option value="">Seleccionar</option>
                                <option value="12">12 Meses</option>
                                <option value="24">24 Meses</option>
                                <option value="36">36 Meses</option>
                                <option value="48">48 Meses</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="display: none" id="tablas">
                        <div class="col-sm-12">
                            <table class="table table-sm table-stripped table-bordered table-hover" style="margin-bottom: 0px;" id="tabla">
                            </table>
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
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {

        $('#prestamo').change(function() {
            var a = $('#prestamo').val();
            var b = $('#meses').val();
            if(a && b) {
                $('#tablas').show();
                var aux = '<tr class="info"><th>Mes</th><th>Pago inicial</th><th>Mensuallidad</th></tr>';
                for(i = 1; i <= b; i++) {
                    aux += '<tr><td>Mes ' + i + '</td><td>' + (i === 1 ? '$' + (a * .1).toFixed(2) : '-') + '</td><td>$' + (a / b).toFixed(2) + ' </td></tr>'
                }
                aux += '<tr class="info"><td colspan="2" class="text-right">Total:</td><td>$' + (a * 1.1).toFixed(2) + '</td></tr>'
                $('#tabla').html(aux);
            } else {
                $('#tablas').hide();
                $('#tabla').html('');
            }
        });

        $('#meses').change(function() {
            var a = $('#prestamo').val();
            var b = $('#meses').val();
            if(a && b) {
                $('#tablas').show();
                var aux = '<tr class="info"><th>Mes</th><th>Pago inicial</th><th>Mensuallidad</th></tr>';
                for(i = 1; i <= b; i++) {
                    aux += '<tr><td>Mes ' + i + '</td><td>' + (i === 1 ? '$' + (a * .1).toFixed(2) : '-') + '</td><td>$' + (a / b).toFixed(2) + ' </td></tr>'
                }
                aux += '<tr class="info"><td colspan="2" class="text-right">Total:</td><td>$' + (a * 1.1).toFixed(2) + '</td></tr>'
                $('#tabla').html(aux);
            } else {
                $('#tablas').hide();
                $('#tabla').html('');
            }
        });

    });

</script>

@endsection