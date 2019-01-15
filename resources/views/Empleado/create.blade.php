@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2>Crear Agente</h2>
        </div>

    </div>
    <div class="card-body">
        <form role="form" name="domicilio" id="form-cliente" method="POST" action="{{route('empleados.store')}}" name="form">
            {{ csrf_field() }}
            <input type="hidden" name="status" value="activo">
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="nombre"><i class="fa fa-asterisk" aria-hidden="true"></i>
                        Nombre(s):</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="apater"><i class="fa fa-asterisk" aria-hidden="true"></i>Apellido
                        Paterno:</label>
                    <input required type="text" class="form-control" id="paterno" name="paterno" value="">
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="amater"><i class="fa fa-asterisk" aria-hidden="true"></i>Apellido
                        Materno:</label>
                    <input required type="text" class="form-control" id="materno" name="materno" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="edad"> <i class="fa fa-asterisk" aria-hidden="true"></i>Edad:</label>
                    <input required type="text" class="form-control" id="edad" name="edad" value="">
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="sexo"><i class="fa fa-asterisk" aria-hidden="true"></i>Sexo:</label>
                    <input required type="text" class="form-control" id="sexo" name="sexo" value="">
                </div>
                <div class="form-group col-4 mt-4 mb-1">
                    <div class="input-group mt-1">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="tipo"><i class="fa fa-asterisk" aria-hidden="true"></i>Tipo
                                Empleado:</label>
                        </div>
                        <select required class="custom-select" id="tipo" name="tipo">
                            <option selected value="">Selecciona...</option>
                            <option value="Asesor">Asesor</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Gerente">Gerente</option>
                            <option value="TKM">TKM</option>
                            <option value="Becarios">Becarios</option>
                            <option value="Mesa de Control">Mesa de Control</option>
                            <option value="Ejecutivo de Cuenta">Ejecutivo de Cuenta</option>
                            <option value="Juridico">Jurídico</option>
                            <option value="Contador">Contador</option>
                            <option value="Jefe de area(Atencion a clientes)">Jefe de Área(Atención a clientes)</option>
                            <option value="Jefe de area(Archivo)">Jefe de Área(Archivo)</option>
                            <option value="Jefe de area(Ventas)">Jefe de Área(Ventas)</option>
                            <option value="Jefe de area(Juridico)">Jefe de Área(Jurídico)</option>
                            <option value="jefe de area(Contabilidad)">Jefe de Área(Contabilidad)</option>
                            <option value="Directivo">Directivo</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="form-group col-4 mt-4 mb-1">
                    <div class="input-group mt-1">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sucursal"><i class="fa fa-asterisk" aria-hidden="true"></i>Sucursal:</label>
                        </div>
                        <select required class="custom-select" id="sucursal" name="sucursal_id">
                            <option selected value="">Selecciona...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-4 mt-4">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="cargo">Cargo:</label>
                        </div>
                        <select required class="custom-select" id="cargo" name="cargo">
                            <option selected value="">Selecciona...</option>
                            <option value="Asesor">Asesor</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Gerente">Gerente</option>
                            <option value="Mesa de trabajo">Mesa de trabajo</option>
                            <option value="Ejecutivo de Cuenta">Ejecutivo de Cuenta</option>
                            <option value="Juridico">Jurídico</option>
                            <option value="Contador">Contador</option>
                            <option value="Gerente de area">Gerente de área</option>
                            <option value="Director de area">Director de área</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-4 mt-4" id="camposupervisor">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="supervisor">Supervisor:</label>
                        </div>
                        <select class="custom-select" id="supervisor" name="supervisor">
                            <option selected value="">Selecciona...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-4 mt-4" id="campogerente">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gerente">Gerente:</label>
                        </div>
                        <select class="custom-select" id="gerente" name="gerente">
                            <option selected value="">Selecciona...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
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
    <script>
        $(document).ready(function () {
            $('#campogerente').hide();
            $('#camposupervisor').hide();
            $('#tipo').change(function () {
                if ($(this).val() == 'Asesor') {
                    $('#campogerente').hide();
                    $("#gerente").val('');
                    $("#gerente").prop('required', false);
                    $('#camposupervisor').show();
                    $("#supervisor").prop('required', true);
                } else if ($(this).val() == 'Supervisor') {
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
            $('#sucursal').click(function () {
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
            });
            $('#gerente').click(function(){
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
            });

        });
    </script>
    @endsection