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
                        <a class="nav-link" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Pagos:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.pagos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Pago</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($pagos && count($prospecto->pagos) > 0)
                    <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr class="info">
                            <th>Fecha del pago</th>
                            <th>Préstamo</th>
                            <th>Meses</th>
                            <th>Cantidad a pagar</th>
                            <th>Monto</th>
                            <th>Restante</th>
                            <th>Status</th>
                            <th>Acción</th>
                        </tr>
                        @foreach($prospecto->cotizaciones as $cotizacion)
                            @foreach($cotizacion->pagos as $pago)
                                <tr>
                                    <td>{{ date('d/m/Y H:m:s', strtotime($pago->created_at)) }}</td>
                                    <td>${{ number_format($pago->cotizacion->prestamo, 2) }}</td>
                                    <td>{{ $pago->cotizacion->meses }} meses</td>
                                    <td>${{ number_format($pago->restante + $pago->monto, 2) }}</td>
                                    <td>${{ number_format($pago->monto, 2) }}</td>
                                    <td>${{ number_format($pago->restante, 2) }}</td>
                                    <td>{{ $pago->status }}</td>
                                    <td class="text-center">
                                        @if($pago == $cotizacion->pagos->last() && $pago->status != "Aprobado")
                                            <a href="{{ route('prospectos.pagos.follow', ['prospecto' => $prospecto, 'pago' => $pago]) }}" class="btn btn-sm btn-warning">
                                                <strong>$</strong> Pagar
                                            </a>
                                        @endif
                                        <a href="{{ route('prospectos.pagos.show', ['prospecto' => $prospecto, 'pago' => $pago]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> Ver
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                @else
                    <h4>No hay pagos disponibles.</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection