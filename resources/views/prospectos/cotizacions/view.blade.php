@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Préstamos:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.cotizacions.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                        </a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
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
                        <input type="text" readonly="" value="{{ $cotizacion->ahorro ? $cotizacion->ahorro : 'N/A' }}" class="form-control">
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
    </div>
</div>

@endsection