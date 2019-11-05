@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <h5>Datos generales del prospecto:</h5>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Nombre:</label>
                <input type="text" class="form-control" value="{{ $prospecto->nombre }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->appaterno }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->apmaterno }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Sexo:</label>
                <input type="text" class="form-control" value="{{ $prospecto->sexo }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Correo electronico:</label>
                <input type="text" class="form-control" value="{{ $prospecto->email }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono:</label>
                <input type="text" class="form-control" value="{{ $prospecto->tel }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono movil:</label>
                <input type="text" class="form-control" value="{{ $prospecto->movil }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Asesor:</label>
                <input type="text" class="form-control" value="{{ $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno }}" readonly="">
            </div>
        </div>
    </div>
    
    <div class="card-header">
        <h4>
            Estudio socioeconómico
        </h4>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="sueldo">Sueldo mensual del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="number" value="{{$prospecto->sueldo}}">
                </div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="ahorro">Ahorro neto del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="number" value="{{$prospecto->ahorro}}">
                </div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="calificacion">Calificación del prospecto:</label>
                <input class="form-control" readonly="" type="number" value="{{$prospecto->calificacion}}">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-12 offset-md-4 col-lg-4 offset-lg-4 col-xl-4 offset-xl-4">
                <label for="estado">Estado del prospecto:</label>
                <input class="form-control" readonly="" type="text" value="{{$prospecto->aprobado ? 'Aprobado' : 'No Aprobado'}}" >
            </div>
        </div>
    </div>
    <div class="card-header">
        <h4>
            Datos del prestamo
        </h4>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <label for="monto">Monto que desea obtener/ monto que puede obtener:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="number" value="{{$prospecto->monto}}">
                </div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <label for="plan">Plan que desea obtener/ plan que puede obtener:</label>
                <input class="form-control" readonly="" type="text" value="{{$prospecto->plan}}" >
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5>C.R.M.:</h5>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('empleados.prospectos.crms.index', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-primary">
                       <i class="far fa-calendar-check"></i><strong> CRM de {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apaterno}}</strong>
                    </a>
                </div>
            </div>
        </div>
        <form method="POST" action="{{$edit ? route('empleados.prospectos.crms.update',['empleado'=>$empleado,'prospecto'=>$prospecto,'crm'=>$crm]) : route('empleados.prospectos.crms.store',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}">
            @csrf
            @if ($edit)
                @method('PUT')
            @endif
            <div class="card-body">
                <div class="row row-group">
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="prospecto">Prospecto:</label>
                        <span class="form-control" readonly>{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apaterno}}</span>
                        <input type="hidden" name="prospecto_id" value="{{$prospecto->id}}" required="required">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="fecha_act">Fecha Actual:</label>
                        <input type="date" name="fecha_act" class="form-control" value="{{date('Y-m-d')}}" readonly="" required="required">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="fecha_contacto">Fecha de contacto:</label>
                        <input type="date" class="form-control" name="fecha_contacto" id="fecha_contacto" required="required" min="{{ date('Y-m-d', strtotime('+2 Days')) }}" max="{{ date('Y-m-d', strtotime('+2 Months')) }}">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="fecha_aviso">Fecha de aviso:</label>
                        <input type="date" class="form-control" name="fecha_aviso" id="fecha_aviso" required="required" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+2 Months')) }}" disabled="">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="hora_contacto">Hora de contacto:</label>
                        <input type="time" class="form-control" name="hora_contacto" required="required">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="tipo_contacto">Forma de contacto:</label>
                        <select type="select" name="tipo_contacto" class="form-control" required="">
                            <option value="">Seleccione una opción</option>
                            <option value="Email/Correo Electronico">Email/Correo Electronico</option>
                            <option value="Telefono">Telefono</option>
                            <option value="Cita">Cita</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="status">Proceso:</label>
                        <select type="select" name="status" class="form-control" required="">
                            <option value="">Seleccione una opción</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Cotizando">En Cotización</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="Tomando decisión">Tomando decisión</option>
                            <option value="En espera">En espera</option>
                            <option value="Revisando documento">Revisando documento</option>
                            <option value="Proceso de Aceptación">Proceso de Aceptación</option>
                            <option value="Para entrega">Para entrega</option>
                            <option value="Perdido">Perdido</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="tareas">Tareas</label>
                        <select class="select-task form-control" name="tareas[]" id="tareas" multiple="multiple">
                            {{-- <option value="enviar">Enviar cotización por email</option> --}}
                          @foreach ($tareas as $tarea)
                              <option value="{{$tarea->id}}" title="{{$tarea->descripcion}}">{{$tarea->nombre}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group" id="cotizacion" style="display: none;">
                        <label for="cotizacion_id">Cotización:</label>
                        <select class="form-control" name="cotizacion_id" id="cotizacion_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($cotizaciones as $cotizacion)
                                <option value="{{$cotizacion->id}}">{{ number_format($cotizacion->propiedad, 2) }} | {{$cotizacion->plan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="comentarios">Comentarios</label>
                        <textarea rows="5" name="comentarios" maxlength="500" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="acuerdos">Acuerdos</label>
                        <textarea rows="5" name="acuerdos" maxlength="500" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea rows="5" name="observaciones" maxlength="500" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div >
                <h5 class="text-danger text-right">✱Campos Requeridos</h5>
                <div class="text-center my-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
            </div>
        </form>
        <hr>
        <div class="row-group">
            <table class="table table-striped table-bordered" id="crms">
                <thead>
                    <tr class="thead-light">
                        <th class="text-center">Prospecto</th>
                        <th class="text-center" style="white-space:nowrap;">Fecha contacto</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center" style="white-space:nowrap;">Fecha aviso</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Celular</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Tarea</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Proceso</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($crms as $crm)
                        <tr class="text-center">
                            <td style="white-space:nowrap;">
                                {{$crm->prospecto->nombre." ".$crm->prospecto->appaterno." ".$crm->prospecto->apaterno}}
                            </td>
                            <td>
                                {{$crm->fecha_contacto}}
                            </td>
                            <td>
                                {{$crm->hora_contacto}}
                            </td>
                            <td style="white-space:nowrap;">
                                {{$crm->fecha_aviso}}
                            </td>
                            <td>
                                {{$crm->prospecto->tel}}
                            </td>
                            <td>
                                {{$crm->prospecto->movil}}
                            </td>
                            <td>
                                {{$crm->prospecto->email}}
                            </td>
                            <td>
                                @foreach ($crm->tasks as $tarea)
                                    <p title="{{$tarea->descripcion}}">{{$tarea->nombre}} {{$tarea->pivot->hecho ? '(hecha)' : '(pendiente)'}}</p>
                                @endforeach
                            </td>
                            <td>
                                {{$crm->status}}
                            </td>
                            <td>
                                <a class="btn btn-sm mt-1 mb-1 ml-1 mr-1 btn-light" href="{{ route('empleados.prospectos.crms.show',['prospecto'=>$crm->prospecto,'empleado'=>$empleado,'crm'=>$crm]) }}"><i class="fas fa-info-circle"></i></a> 
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            No se encontraron registros
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.select-task').select2();
        $("#tareas").on('change',function(e){
            if(this.value == "enviar"){
                $("#cotizacion").css('display',"block");
                $("#cotizacion_id").attr('required',"required");
            }
            else{
                $("#cotizacion_id").removeAttr('required');
                $("#cotizacion").css('display',"none");
            }
        });

        $('#crms').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
    });

    $('#fecha_contacto').change(function() {
        let contacto = $('#fecha_contacto').val();
        nuevaFecha = contacto.split('-');
        // se resta un mes por el modo que empeiza los mese en el objeto Date y se resta un dia para comenzar la fecha de aviso
        let aviso = new Date(nuevaFecha[0], nuevaFecha[1] - 1, nuevaFecha[2] - 1);
        $('#fecha_aviso').val('');
        $('#fecha_aviso').attr("min", aviso.toISOString().split('T')[0]);
        $('#fecha_aviso').attr("max", contacto);
        $('#fecha_aviso').prop('disabled', false);
    });

    </script>
@endpush