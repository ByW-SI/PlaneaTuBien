<div class="card">
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
                @if($prospecto->asesor)
                    <input type="text" class="form-control" value="{{ $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno }}" readonly="">
                @else
                    <input type="text" class="form-control" value="Sin asesor" readonly="">
                @endif
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
            <div class="form-group col-12 col-md-6">
                <label for="sueldo">Sueldo mensual del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->sueldo, 2)}}">
                </div>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="ahorro">Ahorro neto del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->ahorro, 2)}}">
                </div>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="calificacion">Calificación del prospecto:</label>
                <input class="form-control" readonly="" type="number" value="{{$prospecto->calificacion}}">
            </div>
            <div class="form-group col-12 col-md-6">
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
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->monto, 2)}}">
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
                        {{-- @if($cotizacion) --}}
                            {{-- <input type="text" readonly="" value="{{ number_format($cotizacion->monto,2) }}" class="form-control"> --}}
                        {{-- @else --}}
                            <label>--</label>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Ahorro del cliente:</label>
                    <div class="input-group">
                        {{-- @if($cotizacion) --}}
                            {{-- <input type="text" readonly="" value="{{ $cotizacion->ahorro ? $cotizacion->ahorro : 'N/A' }}" class="form-control"> --}}
                        {{-- @else --}}
                            <input type="text" readonly="" value="--" class="form-control">
                        {{-- @endif --}}
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>   
                     </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">      Plan:</label>
                    {{-- @if($cotizacion) --}}
                        {{-- <input type="text" readonly="" value="{{ $cotizacion->plan->nombre }}" class="form-control"> --}}
                    {{-- @else --}}
                        <label>--</label>
                    {{-- @endif --}}
                </div>
            </div>
            <div class="row">
                {{-- @if(isset($cotizacion) && $cotizacion->plan->abreviatura != "PL" && $cotizacion->plan->abreviatura != "TC" && $cotizacion->plan->abreviatura != "TD")
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Monto a adjudicar:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            @if($cotizacion)
                                <input type="text" readonly="" value="{{ number_format($cotizacion->plan->monto_adjudicar($cotizacion->monto,$cotizacion->factor_actualizacion),2) }}" class="form-control">
                            @else
                                <label>--</label>
                            @endif
                        </div>
                    </div>
                @endif --}}
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Plazo:</label>
                    <div class="input-group">
                        {{-- @if($cotizacion && $cotizacion->plan->abreviatura != "PL") --}}
                            {{-- <input type="text" readonly="" value="{{ $cotizacion->plan->plazo }}" class="form-control"> --}}
                        {{-- @else --}}
                            <input type="text" readonly="" value="--" class="form-control">
                        {{-- @endif --}}
                        <div class="input-group-append">
                            <span class="input-group-text">meses</span>
                        </div>
                    </div>
                </div>
                {{-- @if(isset($cotizacion) && $cotizacion->plan->abreviatura != "PL")
                    <div class="form-group col-sm-4">
                        @if($cotizacion)
                            <label class="col-form-label">{{ $cotizacion->plan->mes_adjudicado }} mensualidades de:</label>
                        @else
                            <label class="col-fomr-label">-- mensualidades de:</label>
                        @endif
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            @if($cotizacion)
                                <input type="text" readonly="" value="{{ number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2) }}" class="form-control">
                            @else
                                <input type="text" readonly="" value="--" class="form-control">
                            @endif
                        </div>
                    </div>
                @endif --}}
            </div>
            {{-- @if(isset($cotizacion) && $cotizacion->plan->abreviatura != "PL")
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-stripped table-hover table-bordered">
                        <tr class="info">
                            <th>Aportación extraordinaria</th>
                            <th>%</th>
                            <th>Monto</th>
                            <th>Mes</th>
                        </tr>
                    @if($cotizacion)
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
                    @else
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Monto total:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        @if($cotizacion)
                            <input type="text" value="{{number_format($cotizacion->plan->monto_total_pagar($cotizacion->monto,$cotizacion->factor_actualizacion),2)}}" class="form-control" readonly="">
                        @else
                            <input type="text" value="--" class="form-control">
                        @endif
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Costo anual de:</label>
                    <div class="input-group">
                        @if($cotizacion)
                            <input type="text" value="{{$cotizacion->plan->sobrecosto_anual($cotizacion->monto,$cotizacion->factor_actualizacion)}}" class="form-control" readonly="">
                        @else
                            <input type="text" value="--" class="form-control">
                        @endif
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
                        @if($cotizacion)
                            <input type="text" value="{{ number_format($cotizacion->inscripcion_total,2) }}" class="form-control" readonly="">
                        @else
                            <input type="text" value="--" readonly="" class="form-control">
                        @endif
                    </div>
                </div>
            </div>
            @endif --}}
        </div>
    </div>
    <div class="card-footer">
    </div>
</div>