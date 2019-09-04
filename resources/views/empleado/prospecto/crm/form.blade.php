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
                        <input type="date" class="form-control" name="fecha_contacto" required="required" min="{{ date('Y-m-d', strtotime('+2 Days')) }}" max="{{ date('Y-m-d', strtotime('+2 Months')) }}">
                    </div>
                    <div class="col-12 col-xs-12 col-md-4 form-group">
                        <label for="fecha_aviso">Fecha de aviso:</label>
                        <input type="date" class="form-control" name="fecha_aviso" required="required" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+2 Months')) }}">
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
                            <option value="enviar">Enviar cotización por email</option>
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
            <div class="modal-footer">
                <div class="d-flex justify-content-around">
                        <h5 class="text-danger text-left">✱Campos Requeridos</h5>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
            </div>
        </form>
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
        })
    });
    </script>
@endpush