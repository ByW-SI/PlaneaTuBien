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
                    <h5>Préstamos:</h5>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-success">
                        <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-primary">
                        <i class="fa fa-bars"></i><strong> Lista de Cotizaciones</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Valor de la propiedad:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly="" value="{{ number_format($cotizacion->monto,2) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Ahorro del cliente:</label>
                    <div class="input-group">
                        <input type="text" readonly="" value="{{ $cotizacion->ahorro ? $cotizacion->ahorro : '0' }}" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>   
                     </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">      Plan:</label>
                    <input type="text" readonly="" value="{{ $cotizacion->plan->nombre }}" class="form-control">
                </div>
            </div>
            @if($cotizacion->plan->abreviatura != "PL")
            <div class="row">
                @if($cotizacion->plan->abreviatura != "TC" && $cotizacion->plan->abreviatura != "TD")
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Monto a adjudicar:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly="" value="{{ number_format($cotizacion->plan->monto_adjudicar($cotizacion->monto,$cotizacion->factor_actualizacion),2) }}" class="form-control">
                    </div>
                </div>
                @endif
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Plazo:</label>
                    <div class="input-group">
                        <input type="text" readonly="" value="{{ $cotizacion->plan->plazo }}" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">meses</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">@if($cotizacion->plan->abreviatura != "TC" && $cotizacion->plan->abreviatura != "TD"){{ $cotizacion->plan->mes_s_d-1 }} @endif mensualidades de:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly="" value="{{ number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2) }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-stripped table-hover table-bordered">
                        <tr class="info">
                            <th>Aportación extraordinaria</th>
                            <th>%</th>
                            <th>Monto</th>
                            <th>Mes</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>{{ $cotizacion->plan->aportacion_1 }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_aportacion_1($cotizacion->monto),2) }}</td>
                            <td>{{ $cotizacion->plan->mes_1 }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ $cotizacion->plan->aportacion_2 }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_aportacion_2($cotizacion->monto),2) }}</td>
                            <td>{{ $cotizacion->plan->mes_2 }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>{{ $cotizacion->plan->aportacion_3 }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_aportacion_3($cotizacion->monto),2) }}</td>
                            <td>{{ $cotizacion->plan->mes_3 }}</td>
                        </tr>
                        <tr>
                            <td>Liquidación</td>
                            <td>{{ $cotizacion->plan->aportacion_liquidacion }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_aportacion_liquidacion($cotizacion->monto),2) }}</td>
                            <td>{{ $cotizacion->plan->mes_liquidacion }}</td>
                        </tr>
                        <tr>
                            <td>Anual</td>
                            <td>{{ $cotizacion->plan->anual }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_aportacion_anual($cotizacion->monto),2) }}</td>
                            <td>Cada diciembre</td>
                        </tr>
                        @if ($cotizacion->plan->semestral != 0.00)
                            <tr>
                                <td>Semestral</td>
                                <td>{{ $cotizacion->plan->semestral }}</td>
                                <td>${{ number_format($cotizacion->plan->monto_aportacion_semestral($cotizacion->monto),2) }}</td>
                                <td>Cada junio y diciembre</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            @endif
            <div class="row">
                @if($cotizacion->plan->abreviatura != "PL")
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Total de aportaciones:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" value="{{ number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['total_aportacion'],2) }}" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Costo anual de:</label>
                        <div class="input-group">
                            <input type="text" value="{{ $cotizacion->plan->sobrecosto_anual($cotizacion->monto,$cotizacion->factor_actualizacion) }}" class="form-control" readonly="">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Inscripción:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            @if($cotizacion->inscripcion)
                                <input type="text" value="{{ number_format($inscripcion,2) }}" class="form-control" readonly="">
                            @else
                            <input type="text" value="{{ number_format($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto),2) }}" class="form-control" readonly="">
                            @endif
                        </div>
                    </div>
                    @if($cotizacion->promocion)
                    <div class="form-group col-sm-3">
                        <label>Monto de promoción:</label>
                         <div class="input-group">
                            <input class="form-control" value="{{ $cotizacion->promocion->monto }}" readonly="">    
                            <div class="input-group-append">
                                <span class="input-group-text">{{ $cotizacion->promocion->tipo_monto == "porcentaje" ? "%" : "MXN" }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                @if($cotizacion->promocion)
                    <div class="form-group col-sm-5">
                        <label>Tipo de promoción:</label>
                        <span class="input-group-text" id="tipo_promo">{{ $cotizacion->promocion->tipo_promocion->nombre }}</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                        <label>Valido:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">De: </span>
                            </div>
                            <input type="text" class="form-control"  value="{{ $cotizacion->promocion->valido_inicio }}" readonly="">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">hasta:</span>
                            </div>
                            <input type="text" class="form-control" value="{{ $cotizacion->promocion->valido_fin }}" readonly="">
                        </div>
                    </div>
                    <div class="form-group col-sm-5">
                        <label>Tipo de promoción:</label>
                        <textarea class="form-control" readonly>{{ $cotizacion->promocion->descripcion }}</textarea>
                    </div>
                @endif
            </div>
            <!-- TABLA DE PAGOS MINIMOS Y MAXIMOS PARA PLAN LIBRE-->
            @if($cotizacion->plan->abreviatura == "PL")
                <div class="row my-3">
                    <div class="col-sm-6 offset-3">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mínimo</th>
                                    <th>Posible 1</th>
                                    <th>Posible 2</th>
                                    <th>Posible 3</th>
                                    <th>Máximo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${{ $tablaPL['minimo'] }}</td>
                                    <td>${{ $tablaPL['posible1'] }}</td>
                                    <td>${{ $tablaPL['posible2'] }}</td>
                                    <td>${{ $tablaPL['posible3'] }}</td>
                                    <td>${{ $tablaPL['maximo'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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