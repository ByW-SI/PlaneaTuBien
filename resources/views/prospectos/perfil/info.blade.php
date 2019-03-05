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
                        <input type="text" readonly="" value="{{ number_format($cotizacion->propiedad) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Ahorro del cliente:</label>
                    <div class="input-group">
                        <input type="text" readonly="" value="{{ $cotizacion->ahorro ? $cotizacion->ahorro*100 : 'N/A' }}" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>   
                     </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">      Plan:</label>
                    <input type="text" readonly="" value="{{ $cotizacion->plan }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Monto a adjudicar:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly="" value="{{ $cotizacion->adjudicar }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Plazo:</label>
                    <div class="input-group">
                        <input type="text" readonly="" value="{{ $cotizacion->plazo }}" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">meses</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">{{ $cotizacion->mes3 + 1 }} mensualidades de:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" readonly="" value="{{ $cotizacion->mensualidad }}" class="form-control">
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
                            <td>{{ $cotizacion->porc1 }}</td>
                            <td>{{ $cotizacion->monto1 }}</td>
                            <td>{{ $cotizacion->mes1 }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ $cotizacion->porc2 }}</td>
                            <td>{{ $cotizacion->monto2 }}</td>
                            <td>{{ $cotizacion->mes2 }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>{{ $cotizacion->porc3 }}</td>
                            <td>{{ $cotizacion->monto3 }}</td>
                            <td>{{ $cotizacion->mes3 }}</td>
                        </tr>
                        <tr>
                            <td>Anual</td>
                            <td>{{ $cotizacion->porc4 }}</td>
                            <td>{{ $cotizacion->monto4 }}</td>
                            <td>Cada diciembre</td>
                        </tr>
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
                        <input type="text" value="{{ $cotizacion->total }}" class="form-control" readonly="">
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Costo anual de:</label>
                    <div class="input-group">
                        <input type="text" value="{{ $cotizacion->anual }}" class="form-control" readonly="">
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
                        <input type="text" value="{{ $cotizacion->inscripcion }}" class="form-control" readonly="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
    </div>
</div>