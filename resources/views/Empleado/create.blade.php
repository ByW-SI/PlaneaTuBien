@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Agente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('empleados.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Agentes</strong>
                </a>
            </div>
        </div>
    </div>
    <form role="form" name="domicilio" id="form-cliente" method="POST" action="{{route('empleados.store')}}" name="form">
        {{ csrf_field() }}
        <div class="card-body">
            <input type="hidden" name="status" value="activo">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Apellido Paterno:</label>
                    <input required type="text" class="form-control" id="paterno" name="paterno" value="">
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">Apellido Materno:</label>
                    <input type="text" class="form-control" id="materno" name="materno" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Correo electrónico:</label>
                    <input required type="email" class="form-control" id="email" name="email" value="">
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Edad:</label>
                    <input required type="text" class="form-control" id="edad" name="edad" value="">
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Sexo:</label>
                    <select required class="form-control" name="sexo" id="sexo">
                        <option value="">Seleccionar</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Tipo de Empleado:</label>
                    <select required class="form-control" id="tipo" name="tipo">
                        <option selected value="">Seleccionar</option>
                        <option value="Asesor">Asesor</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Gerente">Gerente</option>
                        <option value="TKM">TKM</option>
                        <option value="Becario">Becario</option>
                        <option value="Mesa de control">Mesa de control</option>
                        <option value="Ejecutivo de cuenta">Ejecutivo de cuenta</option>
                        <option value="Juridico">Jurídico</option>
                        <option value="Contador">Contador</option>
                        <option value="Jefe atención a clientes">Jefe de atención a clientes</option>
                        <option value="Jefe archivo">Jefe de archivo</option>
                        <option value="Jefe ventas">Jefe de ventas</option>
                        <option value="Jefe jurídico">Jefe de jurídico</option>
                        <option value="Jefe contabilidad">Jefe de contabilidad</option>
                        <option value="Directivo">Directivo</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Sucursal:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn" onclick="getSucursales()">↻</span>
                        </div>
                        <select required class="form-control" id="sucursal" name="sucursal_id">
                            <option selected value="">Seleccionar</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Cargo:</label>
                    <select required class="form-control" id="cargo" name="cargo">
                        <option value="">Seleccionar</option>
                        <option value="Asesor">Asesor</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Mesa de trabajo">Mesa de trabajo</option>
                        <option value="Ejecutivo de cuenta">Ejecutivo de cuenta</option>
                        <option value="Juridico">Jurídico</option>
                        <option value="Contador">Contador</option>
                        <option value="Gerente de area">Gerente de área</option>
                        <option value="Director de area">Director de área</option>
                    </select>
                </div>
                <div class="form-group col-sm-4" id="camposupervisor" style="display: none;">
                    <label class="control-label">Supervisor:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn" onclick="getSupervisores()">↻</span>
                        </div>
                        <select class="form-control" id="supervisor" name="supervisor">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-4" id="campogerente" style="display: none;">
                    <label class="control-label">Gerente:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn" onclick="getGerentes()">↻</span>
                        </div>
                        <select class="form-control" id="gerente" name="gerente">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 offset-4 text-center">
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

    function getSucursales() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('buscarsucursales') }}",
            type: "GET",
            dataType: "html",
        }).done(function (resultado) {
            $("#sucursal").html(resultado);
        });
    }

    function getSupervisores() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('buscarsupervisores') }}",
            type: "GET",
            dataType: "html",
        }).done(function (resultado) {
            $("#supervisor").html(resultado);
        });
    }

    function getGerentes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('buscargerentes') }}",
            type: "GET",
            dataType: "html",
        }).done(function (resultado) {
            $("#gerente").html(resultado);
        });
    }

    $(document).ready(function () {

        $('#tipo').change(function () {
            if ($(this).val() == 'Asesor') {
                getSupervisores();
                $('#campogerente').hide();
                $("#gerente").val('');
                $("#gerente").prop('required', false);
                $('#camposupervisor').show();
                $("#supervisor").prop('required', true);
            } else if ($(this).val() == 'Supervisor') {
                getGerentes();
                $('#camposupervisor').hide();
                $("#supervisor").prop('required', false);
                $("#supervisor").val('');
                $('#campogerente').show();
                $("#gerente").prop('required', true);
            } else {
                $('#camposupervisor').hide();
                $("#supervisor").prop('required', false);
                $("#supervisor").val('');
                $('#campogerente').hide();
                $("#gerente").val('');
                $("#gerente").prop('required', false);
            }
        });

    });

</script>

@endsection