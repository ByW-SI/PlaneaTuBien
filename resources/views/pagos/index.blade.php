@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <h1>Historial de Pagos</h1>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Pagos:</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($pagos) > 0)
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
                        @foreach($pagos as $pago)
                            <tr>
                                <td>{{ date('d/m/Y H:m:s', strtotime($pago->created_at)) }}</td>
                                <td>${{ number_format($pago->cotizacion->prestamo, 2) }}</td>
                                <td>{{ $pago->cotizacion->meses }} meses</td>
                                <td>${{ number_format($pago->restante + $pago->monto, 2) }}</td>
                                <td>${{ number_format($pago->monto, 2) }}</td>
                                <td>${{ number_format($pago->restante, 2) }}</td>
                                <td>{{ $pago->status }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <strong>$</strong> Pagar
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
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