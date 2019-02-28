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
        <div class="card-body">
            <div class="row row-group">
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="prospecto">Prospecto:</label>
                    <span class="form-control" readonly>{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apaterno}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="fecha_act">Fecha Actual:</label>
                    <span class="form-control" readonly="">{{$crm->fecha_act}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="fecha_contacto">Fecha de contacto:</label>
                    <span class="form-control" readonly="">{{$crm->fecha_contacto}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="fecha_aviso">Fecha de aviso:</label>
                    <span class="form-control" readonly="">{{$crm->fecha_aviso}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="hora_contacto">Hora de contacto:</label>
                    <span class="form-control" readonly="">{{$crm->hora_contacto}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="tipo_contacto">Forma de contacto:</label>
                    <span class="form-control" readonly="">{{$crm->tipo_contacto}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 offset-md-2">
                    <label for="status">Estado:</label>
                    <span class="form-control" readonly="">{{$crm->status}}</span>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="status">Tareas:</label>
                    <ul class="list-group">
                        @foreach ($crm->tasks as $tarea)
                            <form method="POST" action="{{ route('crms.tareas.tarea_checked',['crm'=>$crm,'tarea'=>$tarea]) }}">
                                @csrf
                                <li class="list-group-item">{{$tarea->nombre}} <input type="checkbox"  {{$tarea->pivot->hecho ? 'checked="" disabled=""' : ''}} onChange="if(confirm('¿Tarea realizada?')){this.form.submit();}else{this.checked = false}"></li>
                            </form>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="comentarios">Comentarios</label>
                    <textarea class="form-control" readonly="">{{$crm->comentarios}}</textarea>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="acuerdos">Acuerdos</label>
                    <textarea class="form-control" readonly="">{{$crm->acuerdos}}</textarea>
                </div>
                <div class="col-12 col-xs-12 col-md-4 form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" readonly="">{{$crm->observaciones}}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-around">
                <a href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
                    <i class="far fa-calendar-check"></i>
                    <strong> C.R.M.</strong>
                </a>
                <a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-success" id="basic-addon1">
                    <i class="fas fa-user-edit"></i>
                    <strong> Editar Prospecto</strong>
                </a>
                <a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <strong> Cotizador</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection