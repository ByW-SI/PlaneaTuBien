@extends('principal')
@section('content')

<div class="card">
    <br>
    @include('componentes.prospectos.datos_generales.show')

    @include('componentes.prospectos.estudios_socioeconomicos.show')
    <br>
    {{-- <div class="card-header">
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
                <input class="form-control" readonly="" type="text" value="{{$prospecto->plan}}">
            </div>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5>Cotizaciones:</h5>
                </div>
                {{-- {{dd($prospecto->perfil)}} --}}
                {{-- @if (!$prospecto->perfil) --}}
                <div class="col-sm-4 text-center">
                    <a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}"
                        class="btn btn-success">
                        <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                    </a>
                </div>
                {{-- @endif --}}
            </div>
        </div>
        <div class="card-body">

            @if ($prospecto->perfil && $prospecto->cotizaciones)
            <a href="{{ route('prospectos.presolicitud.create',['prospecto'=>$prospecto]) }}" class="btn btn-primary"
                id="basic-addon1">
                <i class="fas fa-file-invoice"></i>
                <strong> Generar presolicitud</strong>
            </a>
            @endif

            @if(count($prospecto->cotizaciones) > 0)
            <table class="table table-stripped table-bordered table-hover mt-3" style="margin-bottom: 0px;">
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
                @if($cotizacion->plan_id !== null)
                <tr>
                    <td>{{ $cotizacion->plan->nombre }}</td>
                    <td>${{ number_format($cotizacion->monto, 2) }}</td>
                    @if($cotizacion->plan->abreviatura !== "PL")
                    <td>${{ number_format($cotizacion->plan->monto_total_pagar($cotizacion->monto,$cotizacion->factor_actualizacion),2) }}
                    </td>
                    <td>{{$cotizacion->plan->sobrecosto_anual($cotizacion->monto,$cotizacion->factor_actualizacion)}}%
                    </td>
                    <td>
                        {{$cotizacion->plan->abreviatura != "TC" && $cotizacion->plan->abreviatura != "TD" ? $cotizacion->plan->mes_aportacion_adjudicado." meses de " : "mensualidades de "}}${{ number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2)}}
                    </td>
                    <td>
                        @if($cotizacion->promocion)
                        @if($cotizacion->promocion->tipo_monto == "porcentaje")
                        ${{number_format($cotizacion->inscripcion - ($cotizacion->inscripcion * ($cotizacion->promocion->monto / 100)),2)}}
                        @else
                        ${{number_format($cotizacion->inscripcion - $cotizacion->promocion->monto,2)}}
                        @endif
                        @endif
                    </td>
                    @else
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    @endif
                    <td class="text-center">
                        @if ($cotizacion->elegir == 0)
                        {{-- true expr --}}
                        <a href="{{ route('empleados.prospectos.cotizacions.show', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                            class="btn btn-sm mt-3 btn-primary">
                            <i class="fa fa-eye"></i> Ver
                        </a>
                        {{-- @if($cotizacion->plan->abreviatura != "PL") --}}
                        <a href="{{ route('prospectos.cotizacions.pdf', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                            class="btn btn-sm mt-3 btn-outline-secondary">
                            <i class="fa fa-file"></i> PDF
                        </a>
                        <a href="{{ route('empleados.prospectos.cotizacions.pdf.sendMail', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                            class="btn btn-sm mt-3 btn-outline-secondary">
                            <i class="fas fa-envelope"></i> Enviar por correo
                        </a>
                        {{-- @endif --}}
                        {{-- <a href="{{ route('crear-perfil-sin-cotizacion',['prospecto'=>$prospecto]) }}" class="btn
                        btn-sm mt-3 btn-success"> Seleccionar cotización para crear perfil</a> --}}
                        @else
                        <a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
                            class="btn btn-sm mt-3 btn-success">Ver perfil</a>
                        {{-- false expr --}}
                        @endif

                    </td>
                </tr>
                @else
                <tr>
                    <td>Plan Libre</td>
                    <td>{{ number_format($cotizacion->monto, 2) }}</td>
                    <td colspan="4"></td>
                    <td class="text-center">
                        @if ($cotizacion->elegir == 0)
                        {{-- true expr --}}
                        <a href="{{ route('empleados.prospectos.cotizacions.show', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                            class="btn btn-sm mt-3 btn-primary">
                            <i class="fa fa-eye"></i> Ver
                        </a>
                        {{-- <a href="{{ route('prospectos.cotizacions.pdf', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                        class="btn btn-sm mt-3 btn-outline-secondary">
                        <i class="fa fa-file"></i> PDF
                        </a> --}}
                        {{-- <a href="{{ route('empleados.prospectos.cotizacions.pdf.sendMail', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}"
                        class="btn btn-sm mt-3 btn-outline-secondary">
                        <i class="fas fa-envelope"></i> Enviar por correo
                        </a> --}}
                        <a href="{{ route('prospectos.cotizacions.perfils.create',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}"
                            class="btn btn-sm mt-3 btn-success"> Seleccionar cotización para crear perfil</a>
                        @else
                        <a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
                            class="btn btn-sm mt-3 btn-success">Ver perfil</a>
                        {{-- false expr --}}
                        @endif

                    </td>
                </tr>
                @endif
                @endforeach
            </table>
            @else
            <h4>No hay cotizaciones disponibles.</h4>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-around">
            <a href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
                class="btn btn-info" id="basic-addon1">
                <i class="far fa-calendar-check"></i>
                <strong> C.R.M.</strong>
            </a>
            <a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
                class="btn btn-success" id="basic-addon1">
                <i class="fas fa-user-edit"></i>
                <strong> Editar Prospecto</strong>
            </a>
            {{-- <a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
            class="btn btn-info" id="basic-addon1">
            <i class="fas fa-file-invoice-dollar"></i>
            <strong> Cotizador</strong>
            </a> --}}
            @if ($prospecto->perfil)
            <a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
                class="btn btn-success" id="basic-addon1">
                <i class="fas fa-file-invoice"></i>
                <strong> Perfil</strong>
            </a>

            @endif
        </div>
    </div>
</div>

@endsection