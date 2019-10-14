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
                    <h5>C.R.M. de {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apaterno}}:</h5>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('empleados.prospectos.crms.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-success">
                        <i class="fa fa-plus"></i><strong> Agregar registro</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" method="GET">
                <div class="row row-group">
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
                        <label for="desde">Desde:</label>
                        <input class="form-control" type="date" name="desde" value="{{$desde}}">
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
                        <label for="hasta">Hasta:</label>
                        <input class="form-control" type="date" name="hasta" value="{{$hasta}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                        <label><br></label>
                        <button class="form-control btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>
            </form>

            <div class="row row-group">
                <table class="table table-stripped table-bordered table-hover">
                    <tr class="thead-light">
                        <th class="text-center">Fecha de contacto</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tareas</th>
                        <th class="text-center">Acción</th>
                    </tr>
                    @forelse ($crms as $crm)
                    @foreach ($crm->tasks as $tarea)
                        <tr>
                            <td>
                                {{$crm->fecha_contacto}}
                            </td>
                            <td>
                                {{$crm->hora_contacto}}
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <strong>Telefono: </strong>{{$crm->prospecto->tel}}
                                    </li>
                                    <li>
                                        <strong>Movil: </strong>{{$crm->prospecto->movil}}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$crm->prospecto->email}}
                            </td>
                            <td>
                                {{$crm->status}}
                            </td>
                            <td>
                                
                                    <form method="POST" action="{{ route('crms.tareas.tarea_checked',['crm'=>$crm,'tarea'=>$tarea]) }}">
                                        @csrf
                                        <p>{{$tarea->nombre}} <input type="checkbox"  {{$tarea->pivot->hecho ? 'checked="" disabled=""' : ''}} onChange="if(confirm('¿Tarea realizada?')){this.form.submit();}else{this.checked = false}"></p>
                                    </form>
                                
                            </td>
                            <td>
                                <div class="row justify-content-around">
                                    <a class="btn btn-light" href="{{ route('empleados.prospectos.crms.show',['prospecto'=>$prospecto,'empleado'=>$empleado,'crm'=>$crm]) }}"><i class="fas fa-info-circle"></i><strong> Detalles</strong></a> 
                                    <a class="btn btn-success" href="{{ route('empleados.prospectos.crms.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}"><i class="fas fa-calendar-plus"></i></i><strong> Nuevo</strong></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                    <div class="col alert alert-danger text-center" role="alert">
                        No existe registros para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apaterno}}, puedes agregar un nuevo registro <a href="{{ route('empleados.prospectos.crms.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="alert-link">aquí</a>.
                    </div>
                    @endforelse
                </table>
                <div class="row-group">
                    {{$crms->links()}}
                </div>
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
            @if ($prospecto->perfil)
                <a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-success" id="basic-addon1">
                    <i class="fas fa-file-invoice"></i>
                    <strong> Perfil</strong>
                </a>
            
            @endif
        </div>
    </div>
</div>

@endsection