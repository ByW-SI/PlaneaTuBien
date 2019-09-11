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
                    <h5>Cotizaciones:</h5>
                </div>
                {{-- {{dd($prospecto->perfil)}} --}}
                @if (!$prospecto->perfil)
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if(count($prospecto->cotizaciones) > 0)
                <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                    <tr class="info">
                        <th>Plan</th>
                        <th>Valor de la propiedad</th>
                        <th>Monto total a pagar</th>
                        <th>Costo anual total</th>
                        <th>Mensualidades</th>
                        <th>Inscripción inicial</th>
                        <th>Acción</th>
                    </tr>
                    @foreach($prospecto->cotizaciones as $cotizacion)
                        <tr>
                            <td>{{ $cotizacion->plan->nombre }}</td>
                            <td>${{ number_format($cotizacion->monto, 2) }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_total_pagar($cotizacion->monto,$cotizacion->factor_actualizacion),2) }}</td>
                            <td>{{$cotizacion->plan->sobrecosto_anual($cotizacion->monto,$cotizacion->factor_actualizacion)}}%</td>
                            <td>{{$cotizacion->plan->mes_aportacion_adjudicado." meses de $".number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2)}}</td>
                            <td>${{number_format($cotizacion->inscripcion_total,2)}}</td>
                            <td class="text-center">
                                @if ($cotizacion->elegir == 0)
                                    {{-- true expr --}}
                                    <a href="{{ route('empleados.prospectos.cotizacions.show', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}" class="btn btn-sm mt-3 btn-primary">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('prospectos.cotizacions.pdf', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}" class="btn btn-sm mt-3 btn-outline-secondary">
                                        <i class="fa fa-file"></i> PDF
                                    </a>
                                    <a href="{{ route('empleados.prospectos.cotizacions.pdf.sendMail', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}" class="btn btn-sm mt-3 btn-outline-secondary">
                                        <i class="fas fa-envelope"></i> Enviar por correo
                                    </a>
                                    <a href="{{ route('prospectos.cotizacions.perfils.create',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}" class="btn btn-sm mt-3 btn-success"> Seleccionar cotización para crear perfil</a>
                                @else
                                    <a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-sm mt-3 btn-success">Ver perfil</a>
                                    {{-- false expr --}}
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h4>No hay cotizaciones disponibles.</h4>
            @endif
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
            {{-- <a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
                <i class="fas fa-file-invoice-dollar"></i>
                <strong> Cotizador</strong>
            </a> --}}
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